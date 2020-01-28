<?php
use Moorexa\Model;
use Moorexa\Packages as Package;
use Moorexa\Controller;
use Bootstrap\Alert;

/**
 * Documentation for App Page can be found in App/readme.txt
 *
 *@package	App Page
 *@author  	Moorexa <www.moorexa.com>
 **/

class App extends Controller
{
	/**
    * App/home wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function home()
	{
		
		$this->render('home');
	}
	/**
    * App/container wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function container($action, $containerid)
	{
        // get action view
        $view = $this->provider->getActionView('container', $action);

        if ($containerid != null)
        {
            // get container 
            $container = Query::getContainer($containerid);

            if ($container->row == 0)
            {
                // change view to 'container'
                $view = 'container';
            }

            // make public
            $this->set('container', $container);
        }

        // container edited
        $this->modelAction('editContainer', function($response){
            if ($response)
            {
                Alert::success('Container updated successfully');
            }
        });

        // container created
        $this->modelAction('createContainer', function($rows){
            if ($rows > 0)
            {
                $s = $rows > 1 ? 's' : '';

                Alert::success('('.$rows.') Container'.$s.' created successfully.');
            }
        });

        // container deleted
        $this->modelAction('deleteContainer', function($response){
            if ($response)
            {
                Alert::success('Container deleted successfully.');
            }
        });

        // render view
		$this->render($view);
	}
	/**
    * App/images wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function images($action, $imageid)
	{
        // get action view
        $view = $this->provider->getActionView('images', $action);

        if ($imageid != null)
        {
            // get image 
            $image = Query::getSingleImage($imageid);

            if ($image->row == 0)
            {
                // change view to 'images'
                $view = 'images';
            }

            // make public
            $this->set('image', $image);
        }

        // upload images
        $this->modelAction('uploadImages', function($rows){
            if ($rows > 0)
            {
                $s = $rows > 1 ? 's' : '';

                Alert::success('('.$rows.') Image'.$s.' uploaded successfully.');
            }
        });

        // update image
        $this->modelAction('updateImage', function($response){
            if ($response)
            {
                Alert::success('Image updated successfully.');
            }
        });

		$this->render($view);
	}
	/**
    * App/directives wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function directives($action, $directiveid)
	{
        // get action view
        $view = $this->provider->getActionView('directives', $action);

        $directiveid = intval($directiveid);

        if ($directiveid > 0)
        {
            
            // get directives 
            $directives = Query::getSingleDirective($directiveid);

            if ($directives->row == 0)
            {
                // change view to 'directives'
                $view = 'directives';
            }

            // make public
            $this->set('directive', $directives);
        }

        // directive added
        $this->modelAction('createDirectives', function($rows){
            if ($rows > 0)
            {
                $s = $rows > 1 ? 's' : '';
                Alert::success('('.$rows.') Directive'.$s.' added successfully.');
            }
        });

        // edit directive
        $this->modelAction('editDirective', function($response){
            if ($response)
            {
                Alert::success('Directive updated successfully');
            }
        });

		$this->render($view);
	}
	/**
    * App/configuration wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function configuration()
	{
        $this->modelAction('updateConfiguration', function($response){

            if ($response)
            {
                Alert::success('Configuration updated successfully.');
            }

        });
		$this->render('configuration');
	}
	/**
    * App/users wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function users($action, $userid)
	{
        // get action view
        $view = $this->provider->getActionView('users', $action);

        // build form rule
        $model = createModelRule(function($body){ $body->allow_form_input(); });

        // set delete config
        dropbox('deleteConfig', ['type' => 'danger', 'title' => 'Delete an account', 'message' => 'This action would delete this user account. Click "Okay" to continue']);

        // get user account
        if ($userid != null)
        {
            // get user 
            $user = Query::getUser($userid);

            if ($user->row == 0)
            {
                // change view to 'users'
                $view = 'users';
            }
            else
            {
                if (!$model->has('fullname'))
                {
                    $model->pushObject($user);
                }
            }
        }

        // model submitted
        $this->modelAction('addAUser', function($response) use (&$model)
        {
            if ($response)
            {
                $fullname = $model->fullname;
                $model->clear();

                Alert::success('User "'.$fullname.'" created successfully!');
            }
        });

        // user updated
        $this->modelAction('updateUser', function($response) use (&$model)
        {
            if ($response)
            {
                $fullname = $model->fullname;
                Alert::success('User "'.$fullname.'" updated successfully!');
            }
        });

        // user deleted
        $this->modelAction('deleteUser', function($response){
            if ($response)
            {
                Alert::success('User deleted successfully');
            }
        });

		$this->render($view, ['model' => $model]);
	}
	/**
    * App/login wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function login()
	{
        if ($this->has('loginMessage'))
        {
            // get message sent
            $messageSent = $this->loginMessage;

            // send message to screen
            call_user_func(Alert::class . '::' . $messageSent->type, $messageSent->message);
        }

		$this->render('login');
	}
	/**
    * App/sign-out wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function signOut()
	{
        // remove vars from session
        session()->drop('zema.user.token', 'zema.user.id', 'zema.login.redirectTo');

        // redirect to login
        $this->redir('zema/login', ['message' => 'You\'ve signed out successfully. Please come back soon.', 'type' => 'success']);
	}
	/**
    * App/pages wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function pages($action, $pageid)
	{
        // get action view
        $view = $this->provider->getActionView('pages', $action);

        $pageid = intval($pageid);

         // get navigation info
         if (is_int($pageid) && $pageid > 0)
         {
             // get info 
             $nav = Query::getNavigationById($pageid);
 
             if ($nav->row == 0)
             {
                 // change view to 'pages'
                 $view = 'pages';
             }

             dropbox('page', $nav);
         }

        $view = ($action == 'edit-view') ? 'pages/'.$action : $view;

        // get base directory
        $basepath = env('bootstrap')['controller.basepath'];

        // get controllers
        $controllers = glob($basepath . '/*');

        // all views for controller
        $controllerViews = [];

        foreach ($controllers as $controller)
        {
            if ($controller != '.' && $controller != '..')
            {
                // get views 
                $views = getAllFiles($controller . '/Views');
                $controllerViews[basename($controller)] = $views;
            }
        }
        
		$this->render($view, ['controllerViews' => $controllerViews]);
	}
	/**
    * App/install wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function install()
	{
		$this->render('install');
	}
	/**
    * App/plugins wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function plugins($plugin, $action)
	{
        $view = $this->provider->getActionView('plugins', $action);

        if (!is_null($plugin))
        {
            // check if plugin exist
            $directory = CMS_ROOT . 'Installations/Plugins/' . ($plugin);

            if (is_dir($directory))
            {
                // load configuration
                $plugin = call_user_func('\Installations\Plugins\\'.ucfirst($plugin).'\\'.ucfirst($plugin).'::config');

                // is array ? then load configuration
                if (is_array($plugin))
                {
                    // check if base path for view exists in config array
                    if (isset($plugin['view']))
                    {
                        // get view base path
                        $baseViewPath = $plugin['view'];
                        
                        // default view
                        $pluginView = $baseViewPath . 'home.html';

                        if ($action != 'plugins')
                        {
                            // check if view exists
                            if (file_exists($baseViewPath . $action . '.html'))
                            {
                                $pluginView = $baseViewPath . $action . '.html';
                            }
                        }

                        if (file_exists($pluginView))
                        {
                            dropbox('pageTitle', 'Plugins/'.ucfirst(basename($directory)));

                            // set main view
                            $view = $pluginView;
                        }

                    }
                }
            }
        }

		$this->render($view);
	}
	/**
    * App/tables wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function tables($action, $tableAction, $rowid)
	{
        $view = $this->provider->getActionView('tables', $action);

        // check if table requested
        if (!is_null($action))
        {
            if (Moorexa\DB\Table::exists($action))
            {
                $linker = Query::getTableByLinker($action);

                if ($linker->rows > 0)
                {
                    // set page title
                    dropbox('pageTitle', 'Tables/' . $linker->table_identifier);
                    dropbox('tableInfo', $linker);

                    // set view
                    $view = 'tables/show';

                    if ($tableAction != null)
                    {
                        $tableAction = $tableAction == 'edit' ? 'editTable' : $tableAction;

                        if ($tableAction != 'delete' && $tableAction != 'trigger-confirm')
                        {
                            $view = 'tables/' . $tableAction;
                        }
                    }
                }
            }
            else
            {
                $view = $view == 'tables/create' ? 'tables/createTable' : $view;
            }
        }


		$this->render($view);
	}
}
// END class