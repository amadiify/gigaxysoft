<?php

namespace CmsGlobal;

use Moorexa\DB\FetchRow as FetchRow;
use Database\Query;
use Moorexa\Route;
use Moorexa\Rexa;


class Cms
{
    const NO_CACHE = false;
    const DEFAULT_THEME = 'Tabler';

    private static $images = [];

    // set your site id
    public $siteID = 'ABRDI';

    // create navigation
    private static $navigation = [
        'home' => [
            'icon' => 'fe-home',
            'link' => 'zema/home'
        ],
        'container' => [
            'icon' => 'fe-package',
            'link' => 'zema/container'
        ],
        'directives' => [
            'icon' => 'fe-git-branch',
            'link' => 'zema/directives'
        ],
        'images' => [
            'icon' => 'fe-image',
            'link' => 'zema/images'
        ],
        'pages' => [
            'icon' => 'fe-layout',
            'link' => 'zema/pages'
        ],
        'Configuration' => [
            'icon' => 'fe-settings',
            'link' => 'zema/configuration'
        ],
        'users' => [
            'icon' => 'fe-users',
            'link' => 'zema/users'
        ],
        'install' => [
            'icon' => 'fe-cpu',
            'link' => 'zema/install'
        ],
        'plugins' => [
            'icon' => 'fe-cpu',
            'link' => 'zema/plugins'
        ]
    ];

    public static function pageIsActive(FetchRow $parent) : string
    {
        // get current controller and view
        $currentLink = uri()->pathAsString();

        if ($currentLink == $parent->page_link)
        {
            return 'active';
        }

        return '';
    }

    // load directives
    public static function loadDirectives()
    {
        // get all directives
        $directives = Query::getAllDirectives();

        // add to global namespace if directives exists.
        $directives->obj(function($row){

            // load directive
            \Moorexa\Rexa::directive($row->directive, [$row->directive_class, $row->directive_method]);
        }); 

        // set base path
        if (!defined('CMS_ROOT'))
        {
            define('CMS_ROOT', boot()->get('CMS')->getRoot() . '/');
        }

        // load installations
        self::loadInstallation();
    }

    // load image directive
    public static function loadImages(string $imageName) : string
    {
        if (count(self::$images) == 0)
        {
            self::$images = Query::getAllImages();
        }

        if (isset(self::$images[$imageName]))
        {
            return self::$images[$imageName];
        }

        return '';
    }

    // load breadcum title
    public static function loadBreadcumTitle()
    {
        // get current link 
        $currentLink = uri()->pathAsString();

        // get navigation by this link
        $linkData = Query::getNavigationByLink($currentLink);

        if ($linkData->row > 0)
        {
            return ucwords($linkData->breadcum_title);
        }

        return null;
    }

    // load breadcum description
    public static function loadBreadcumDescription()
    {
        // get current view
        $view = uri()->view;
        $intro = $view . '-page-intro';

        // get container
        $container = boot()->get('Container')->getContainer($intro, Cms::NO_CACHE);

        return $container;
    }

    // goto a page
    public static function gotoDirective(string $path) : string
    {
        return url($path);
    }

    // listen for page routes
    public function listenForPageRoutes()
    {
        Route::controller('zema', function()
        {
            // check authentication
            $this->checkAuthentication();
            
            // load template
            $this->loadTemplate();

            // get route url
            $url = Route::getUrl();

            // set base path
            env('bootstrap.controller.basepath', HOME . 'lab/Cms/MVC');

            // replace 'godoit' with 'app'
            $url[0] = 'app';

            // set page title
            dropbox('pageTitle', (isset($url[1]) ? $url[1] : config('router.default.view')));

            // export navigation
            dropbox('navigation', self::$navigation);

            // create navigation directive to get links
            Rexa::directive('navigation', [Cms::class, 'navigationDirective']);

            // return url
            return implode('/', $url);
        });
    }

    // load button base on permission
    public static function loadButton(array $config, int $primarykey = 0)
    {
        // build button tag
        static $buttons = [
            'edit'   => 'fe-edit',
            'update' => 'fe-edit',
            'delete' => 'fe-trash',
            'create' => 'fe-plus',
            'upload' => 'fe-upload',
            'destroy' => ''
        ];

        // get provider
        $provider = \Moorexa\Bootloader::$currentClass->provider;

        // get requesting view
        $view = uri()->view;

        // get view from dropbox
        $containerView = dropbox('container.view');

        if ($containerView !== false)
        {
            $view = $containerView;
        }

        // create new button
        $newbutton = [];

        // get groups
        $groups =  array_flip(Query::getUserPermissionGroupFromSession());

        // check if view action exists
        if (isset($provider->viewActions[$view]))
        {
            // get actions
            $actions = $provider->viewActions[$view];

            foreach ($config as $isKey => $KeyOrValue)
            {
                // allowed to use button ?
                if (isset($groups[$isKey]) || isset($groups[$KeyOrValue]))
                {
                    // icon
                    $icon = isset($buttons[$KeyOrValue]) ? $buttons[$KeyOrValue] : (isset($buttons[$isKey]) ? $buttons[$isKey] : null);

                    // defined in viewactions
                    if (isset($actions[$KeyOrValue]))
                    {
                        $link = 'zema/' . $actions[$KeyOrValue] . ($primarykey != 0 ? '/' . $primarykey : '');
                        $newbutton[] = ['name' => $KeyOrValue, 'link' => url($link), 'icon' => $icon];
                    }
                    else
                    {
                        $link = 'zema/' . $KeyOrValue . ($primarykey != 0 ? '/' . $primarykey : ''); 
                        $newbutton[] = ['name' => $isKey, 'link' => url($link), 'icon' => $icon];  
                    }
                }

            }
        }
        else
        {
            foreach ($config as $isKey => $KeyOrValue)
            {
                // allowed to use button?
                if (isset($groups[$isKey]) || isset($groups[$KeyOrValue]))
                {
                    if (isset($buttons[$KeyOrValue]))
                    {
                        $newbutton[] = ['name' => $KeyOrValue, 'icon' => $buttons[$KeyOrValue]];
                    }
                    else 
                    {
                        if (isset($buttons[$isKey]))
                        {
                            $newbutton[] = ['name' => $isKey, 'link' => url($KeyOrValue), 'icon' => $buttons[$isKey]]; 
                        }
                    }
                }
            }
        }

        // return new button
        return $newbutton;
    }

    // template
    public function loadTemplate()
    {
        // check if template exists
        $theme = $this->getRoot() . '/Theme/' . Cms::DEFAULT_THEME;

        if (is_dir($theme))
        {
            // define constant
            $constant = strtoupper(Cms::DEFAULT_THEME . '_BASE');

            // Define base path
            if (!defined($constant))
            {
                define($constant, $theme);
            }
            
            // get config
            $config = $theme . '/config.php';

            // include if file exists
            if (file_exists($config))
            {
                // include theme interface
                include_once __DIR__ . '/ThemeInterface.php';

                // include config
                include_once $config;

                // load component directive
                call_user_func(Cms::DEFAULT_THEME . '::loadComponents');

                // get statics 
                $loadStatic = $theme . '/loadStatic.json';

                // load if exists
                if (file_exists($loadStatic))
                {
                    // get assets instance
                    $assets = boot()->get('Moorexa\Assets');

                    // create reflection for theme class
                    $reflection = new \ReflectionClass(Cms::DEFAULT_THEME);

                    // check if assets path exists
                    if ($reflection->hasConstant('ASSETS'))
                    {
                        // get assets path
                        $assetsPath = $reflection->getConstant('ASSETS');
                        
                        // change js and css path
                        $assets->changePath(
                            [
                                'css_path' => $assetsPath,
                                'js_path' => $assetsPath
                            ]
                        );

                        // export asset path
                        dropbox('assetPath', url($assetsPath));

                        // get json
                        $json = read_json($loadStatic, true);

                        // get paths
                        $data = ['stylesheet' => [], 'scripts' => [], 'scripts@bundle' => []];

                        // get css paths
                        foreach ($json['stylesheet'] as $css)
                        {
                            $data['stylesheet'][] = $assets->css($css);
                        }

                        // get bundle
                        if (count($json['stylesheet@bundle']) > 0)
                        {
                            foreach ($json['stylesheet@bundle'] as $cssBundle)
                            {
                                $data['stylesheet@bundle'][] = $assets->css($cssBundle);
                            }
                        }

                        // get js paths
                        foreach ($json['scripts'] as $js)
                        {
                            $data['scripts'][] = $assets->js($js);
                        }

                        // get bundle
                        if (count($json['scripts@bundle']) > 0)
                        {
                            foreach ($json['scripts@bundle'] as $jsBundle)
                            {
                                $data['scripts@bundle'][] = $assets->js($jsBundle);
                            }
                        }

                        // load to static
                        config('loadStatic', (object) $data);

                        // reset paths
                        $assets->resetPath();
                    }
                }
            }
        }
    }

    // check authentication
    public function checkAuthentication()
    {
        // redirect 
        $redirect = false;

        // check if session has zema id
        if (!session()->has('zema.user.id', $userid))
        {
            $redirect = true;
        }

        // check 
        if (!$redirect)
        {
            $user = db('users')->get('userid=?', $userid);

            $redirect = true;

            if ($user->rows > 0)
            {
                // get token 
                $token = session()->get('zema.user.token');

                if ($token === $user->loggedinToken)
                {
                    $redirect = false;
                }
            }
        }

        if ($redirect)
        {
            session()->set('zema.login.redirectTo', Route::getUrl());

            // redirect to login page
            redirect('zema/login', ['message' => 'Your session has expired. Please login again to continue', 'type' => 'error']);
        }
    }

    // navigation directive
    public static function navigationDirective(string $navTitle)
    {
        if (isset(self::$navigation[$navTitle]))
        {
            return url(self::$navigation[$navTitle]['link']);
        }
        
        return null;
    }

    // load installation
    public static function loadInstallation()
    {
        $plugins = ['Events', 'Gallery'];

        // load them
        foreach ($plugins as $plugin)
        {
            // get class name
            $className = ucfirst($plugin);

            // define root directory
            $rootDir =  CMS_ROOT . 'Installations/Plugins/' . $className . '/';

            // constant name
            $constant = strtoupper($className) . '_PLUGIN_BASE';

            // not defined ?
            if (!defined($constant))
            {
                define($constant, $rootDir);
            }

            // load init method
            call_user_func('\Installations\Plugins\\'.$className.'\\'.$className.'::init');
        }
    }

    // get root
    private function getRoot()
    {
        // get script filename
        $filename = $_SERVER['SCRIPT_FILENAME'];

        // get base name 
        $basename = basename($filename);

        // remove basename from $filename
        $filename = rtrim($filename, $basename);

        // covert backward slash to forward slash
        $filename = str_replace('\\','/', $filename);

        // get root
        $root = __DIR__;

        // covert backward slash to forward slash
        $root = str_replace('\\','/', $root);

        // remove filename from root
        $root = str_ireplace($filename, '', $root);

        // return root
        return HOME . $root;
    }
}