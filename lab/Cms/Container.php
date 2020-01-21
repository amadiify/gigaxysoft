<?php

namespace Cms;

// create custom directives
use Moorexa\Rexa;

// interpolate string
use Hyphe\Engine;

// manages class instances
use utility\Classes\BootMgr\Manager as BootMgr;

// write to file
use Moorexa\File; 

/**
 * @package Container for our CMS
 * @author WekiWork Creative Lab
 */
class Container
{
    public $containers = []; // pack all containers from the database
    public $templateEngine; // instance of Moorexa/TemplateEngine

    public function __construct()
    {
        // load all containers
        \Moorexa\DB::table('containers')->get()->obj(function($row){
            $this->containers[$row->container_name] = $row->container_body;
        });

        // create engine instance;
        $this->templateEngine = BootMgr::singleton_as('engine', \Moorexa\TemplateEngine::class);

        // create directive
        Rexa::directive('container', function(string $container_name, bool $cacheContainer = true)
        {
            $this->getContainer($container_name, $cacheContainer);
        });
    }

    // get container
    public function getContainer(string $container_name, bool $cacheContainer = true)
    {
        // container data
        $data = null;

        if (isset($this->containers[$container_name]))
        {
            // check watchman.json
            $path = __DIR__ . '/Containers/watchman.json';

            $json = read_json($path, true);

            $data = $this->containers[$container_name];

            if ($cacheContainer)
            {
                // check if container has been cached
                switch (isset($json[$container_name]))
                {
                    case true:
                        
                        $hash = $json[$container_name];

                        if (md5($data) == $hash)
                        {   
                            return $this->includeContainer($container_name);
                        }

                        return $this->cacheContainer($path, $data, $container_name, $json);
                        

                    case false:
                        return $this->cacheContainer($path, $data, $container_name, $json);

                }
            }

            return $data;
        }
    }

    // cache container
    public function cacheContainer(string $watchman, string $data, string $container_name, array $json)
    {
        // hash data and use it for the value and watch when it's updated
        $hash = md5($data);

        // interpolate string
        $interploate = $this->templateEngine->interpolateExternal($data);

        // add to watchman
        $json[$container_name] = $hash; 
        
        // save to watchman
        save_json($watchman, $json);

        // build container path
        $containerPath = __DIR__ . '/Containers/' . $container_name . '.html';

        // save to container path
        File::write($interploate, $containerPath);

        // include path
        $this->includeContainer($container_name);
    }

    // include container
    public function includeContainer(string $container_name)
    {
        // build container path
        $containerPath = __DIR__ . '/Containers/' . $container_name . '.html';

        // extract vars from dropbox
        extract(\Moorexa\Controller::$dropbox);

        // load assets
        $assets = boot()->get('Moorexa\Assets');

        // include
        include $containerPath;
    }
}