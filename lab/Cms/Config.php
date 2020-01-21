<?php

namespace Cms;

use Moorexa\DB;
use WekiWork\Http;
use Database\Query;
use utility\Classes\BootMgr\Manager as Boot;

class Config
{
    public function __construct()
    {
        // get configuration
        $config = Query::getConfig();
        
        if ($config->rows > 0)
        {
            // build config data
            $data = (object) [
                'author' => 'WekiWork Creative Lab',
                'description' => $config->description,
                'keywords' => $config->keywords,
                'icon' => ($config->favicon == '' ? config('public.icon') : $config->favicon),
                'developer' => 'WekiWork',
                'support' => 'support@wekiwork.com'
            ];

            // set global config
            config('public', $data);

            // set site name
            config('title', $config->sitename);

            // set default controller
            config('router.default.controller', $config->default_controller);

            // set default view
            config('router.default.view', $config->default_view);
        }
    }

    // load static
    public function loadStatic()
    {
        // get assets
        $config = Query::getAssets();

        // stylesheets
        $stylesheet = [];

        // scripts
        $scripts = [];

        // extract assets from db
        $config->obj(function($row) use (&$stylesheet, &$scripts){
            switch ($row->tag)
            {
                case 'css':
                    $stylesheet[] = $row->path;
                break;

                case 'js':
                    $scripts[] = $row->path;
                break;
            }
        });

        if (count($stylesheet) > 0)
        {
            $data = (object) [
                'stylesheet' => $stylesheet,
                'scripts' => $scripts,
                'stylesheet@bundle' => ['theme/bundle.css'],
                'scripts@bundle' => ['theme/bundle.js'],
            ];

            // load static
            config('loadStatic', $data);
        }
    }

    // create route if added to db then reload page
    public function createRouteIfAddedToNavigation(string $request)
    {
        // check navigation
        $navigation = Query::getNavigationByLink($request);

        if ($navigation->rows > 0)
        {
            // get assist token
            // from bootstrap config
            $assistToken = env('bootstrap', 'assist_token');

            // send request to assist utility manager                
            $create = Http::sameOrigin(function($http) use ($assistToken, $request)
            {
                $http->header('assist-cli-token:'.$assistToken)->get('new route '. $request);
            });

            if ($create->status == 200)
            {
                // reload this page
                redirect(url($request));
            }
        }
    }

    // load page information
    public function loadPageInformation()
    {
        // current link
        $currentLink = uri()->pathAsString();

        // get navigation info
        $linkData = Query::getNavigationByLink($currentLink);

        if ($linkData->row > 0)
        {
            if ($linkData->page_title != '')
            {
                config('title', $linkData->page_title);
            }

            // get public data
            $public = config('public');

            // get keywords and description
            if ($linkData->keyword != '')
            {
                $public->keywords = $linkData->keyword;
            }

            // add description if content exists
            if ($linkData->description != '')
            {
                $public->description = $linkData->description;
            }

            // save configuration
            config('public', $public);
        }

        // load package again
        \Moorexa\View::loadPackage();
    }

    // load boot
    public static function loadBoot()
    {
        Boot::called('Moorexa\UrlConfig', function()
        {
            // add prefix
            DB::prefix('Zema_');
            
            // load queries
            Boot::singleton_as('Query', 'Database\Query');
            Boot::singleton_as('CMS', 'CmsGlobal\Cms')->loadDirectives();
        
            // load cms config
            Boot::singleton_as('Config', 'Cms\Config')->loadStatic();
        
            Boot::called('Moorexa\View', function()
            {
                // load cms container class
                Boot::singleton_as('Container', 'Cms\Container');
            });
        });
        
        // db handler called
        Boot::called('Moorexa\DatabaseHandler@createConnection', function($boot)
        {
            $boot->promise('data', function($instance)
            {
                $instance->channel(function($request)
                {
                    // get siteid
                    $siteid = boot()->get('CMS')->siteID;
        
                    $request->has('get', function($table, $query) use ($siteid)
                    {
                        if (preg_match('/^(Zema_)/', $table))
                        {
                            if ($table != 'Zema_permission' && $table != 'Zema_navigationtypes')
                            {
                                // add where
                                $query->andWhere('siteid=?', $siteid);
                            }
                        }
                    });
        
                    // insert data
                    $request->has('insert', function($table, $query) use ($siteid)
                    {
                        if (preg_match('/^(Zema_)/', $table))
                        {
                            $query->setArgument('siteid', $siteid)->reBuild();
                        }
                    });
                });
            });
        });
        
        // 204 error occured
        Boot::called('http_error@204', function()
        {
            // get request
            $request = uri()->pathAsString();
        
            // get config
            $config = Boot::get('Config');
        
            // create route if added to the db and reload page
            $config->createRouteIfAddedToNavigation($request);
        });
        
        // apply cms routes
        Boot::called('System@route', function(){
            Boot::get('CMS')->listenForPageRoutes();
        });
    }
}