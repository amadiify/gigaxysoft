<?php

use Cms\ThemeInterface;
use Moorexa\Rexa;
use Moorexa\View;

class Tabler implements ThemeInterface
{
    // paths
    const ASSETS = TABLER_BASE .'/assets/';
    const COMPONENTS = TABLER_BASE .'/components/';

    // load image
    public function getImage(string $imageName) : string
    {
        // get assets
        $assets = boot()->get('Moorexa\Assets');

        // change path
        $assets->changePath([
            'image_path' => Tabler::ASSETS . 'images/'
        ]);

        // load image
        return $assets->image($imageName);
    }

    // load css
    public function getCss(string $cssName) : string
    {
        // get assets
        $assets = boot()->get('Moorexa\Assets');

        // change path
        $assets->changePath([
            'css_path' => Tabler::ASSETS . 'css/'
        ]);

        // load css
        return $assets->css($cssName);
    }

    // load javascript
    public function getJs(string $jsName) : string
    {
        // get assets
        $assets = boot()->get('Moorexa\Assets');

        // change path
        $assets->changePath([
            'js_path' => Tabler::ASSETS . 'js/'
        ]);

        return '';
    }

    // load components
    public static function loadComponents()
    {
        Rexa::directive('component', function(string $componentName, $args = [])
        {
            // watch component called
            self::componentCalled($componentName);

            // return component
            return self::getComponent($componentName, $args);
        }); 
    }

    // get component
    public static function getComponent(string $component, array $arguments = [])
    {
        // build path
        $path = Tabler::COMPONENTS . '@' . $component;

        // get instance of this class
        $tabler = boot()->get('Tabler');

        // add instance to arguments
        $arguments['tabler'] = $tabler;

        // load partial
        return View::partial($path, $arguments);
    }

    // listen for component called
    public static function componentCalled(string $componentName)
    {
        if ($componentName == 'alert-confirm')
        {
            // hide alert
            dropbox('showAlert', false);

            // get paths
            $path = uri()->paths();

            // replace controller
            $path[0] = 'zema';

            // get full path
            $path = implode('/', $path);

            // Collect vars 
            $get = $_GET;
            
            // remove __app_request__
            unset($get['__app_request__']);

            // check for trigger
            if (strpos($path, 'trigger-confirm') !== false)
            {
                // show alert
                dropbox('showAlert', true);

                // get cancel link
                $cancelLink = substr($path, 0, strpos($path, '/trigger-confirm'));

                // get alert link
                $path = str_replace('/trigger-confirm', '', $path);

                if (count($get) > 0)
                {
                    $query = http_build_query($get);
                    $path .= '?' . $query;
                }

                // set alert link
                dropbox('alertLink', url($path));

                // set current link
                dropbox('currentUrl', url($cancelLink));

            }
        }
    }
}