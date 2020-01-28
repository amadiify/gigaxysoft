<?php
namespace Moorexa;

use Moorexa\DB;
use Moorexa\Event;
use Moorexa\HttpPost as Post;
use Moorexa\HttpGet as Get;
use Bootstrap\Alert;

/**
 * App model class auto generated.
 *
 *@package	App Model
 *@author  	Moorexa <www.moorexa.com>
 **/

class App extends Model
{
    public $table = '';

    // add a trigger for users
    public $triggers = [
        'users' => ['create' => 'post:addAUser', 'edit' => 'post:updateUser', 'delete' => 'get:deleteUser'],
        'pages' => ['edit-view' => 'post:updateView', 'edit-nav' => 'post:updateNavigation', 
                    'create' => 'post:createNavigation', 'delete' => 'get:deleteNav'],
        'plugins' => ['create' => 'callPluginMethods', 'edit' => 'callPluginMethods', 'delete' => 'callPluginMethods'],
        'tables' => ['create' => 'post:addTableConfig', 'edit' => 'editTableConfig', '/(getApp)(.*?)(Delete)/' => 'deleteTableRow']
    ];

    // argument indexing
    public $argumentIndexing = [
        'callPluginMethods' => 2, // start from index 2
    ];

    // update configuration
    public function updateConfiguration(Post $post)
    {
        $file = $post->files['favicon'];

        if ($file['error'] == 0)
        {
            // has image
            $destination = APP_PATH . 'Uploads/favicon_'.$file['name'];

            if (move_uploaded_file($file['tmp_name'], $destination))
            {
                $post->set('favicon', $destination);
            }
        }

        // update database
        if (db('config')->update($post->data(), 'configid=?', 1)->ok)
        {
            return true;
        }

        return false;
    }

    // add a user
    public function addAUser(Post $post)
    {
        // check to verify password
        if ($post->password2 == $post->password)
        {
            $post->remove('password2');

            // add createdby
            $post->set('createdby', session()->get('zema.user.id'));

            // hash password
            $post->set('password', Hash::digest($post->password));

            // add user
            if (db('users')->insert($post->data())->go()->ok)
            {
                return true;
            }
        }

        // password do not match
        Alert::error('Password provided do not match');

        return false;
    }

    // update user
    public function updateUser(Post $post, $userid)
    {
        // check to verify password
        if ($post->password2 == $post->password)
        {
            $post->remove('password2');

            if (strlen(trim($post->password)) == 0)
            {
                $post->remove('password');
            }
            else
            {
                $post->set('password', Hash::digest($post->password));
            }

            // update account
            if (db('users')->update($post->data(), 'userid=?', $userid)->go()->ok)
            {
                return true;
            }

            return false;
        }

        // password do not match
        Alert::error('Password provided do not match');

        return false;
    }

    // delete user
    public function deleteUser($method, $userid)
    {
        if ($userid != session()->get('zema.user.id'))
        {
            if (db('users')->delete('userid=?', $userid)->ok)
            {
                return true;
            }
        }

        return false;
    }

    // authenticate user
    public function authenticateUser(Post $post)
    {
        // open database connection to table
        $user = db('users');

        // check
        if ($post->has('username', $username))
        {
            // check for table row
            $getAccount = $user->get('username=?', $username);

            if ($getAccount->rows > 0)
            {
                if ($post->has('password', $password))
                {
                    dropbox('username', $username);

                    // verify password
                    if (Hash::verify($password, $getAccount->password))
                    {
                        // generate token
                        $token = md5(time() . $getAccount->password . env('bootstrap', 'secret_key'));
                        // save token
                        $getAccount->update(['loggedinToken' => $token]);
                        // make token avaliable gloabally
                        session()->set('zema.user.token', $token);
                        // make user id avaliable globally
                        session()->set('zema.user.id', $getAccount->userid);

                        // check for redirect
                        if (session()->has('zema.login.redirectTo', $redirect))
                        {
                            if ($redirect[1] != 'login')
                            {
                                $location = implode('/', $redirect);

                                // remove zema.login.redirectTo
                                session()->drop('zema.login.redirectTo');

                                // redirect
                                redirect($location);
                            }
                        }

                        // redirect to home page
                        redirect('zema/home');
                    }

                    // invalid password
                    Alert::error('Invalid password. Please try again');
                }

                // no password sent
                Alert::error('No password sent. Login failed!');
            }

            // invalid username
            Alert::error('Invalid Username "'.$username.'". Login failed');
        }

        // no username sent
        Alert::error('No username sent. Login failed!');
    }

    // edit view
    public function updateView(Post $post, Get $get)
    {
        $path = $get->path;
        $body = $post->view_body;

        file_put_contents($path, $body);
        
        Alert::success('View Updated successfully.');
    }

    // update navigation
    public function updateNavigation(Post $post, int $navigationid)
    {
        $this->table = 'navigation';

        // update
        if ($this->update($post->data())->where('navigationid = ?', $navigationid)->ok)
        {
            Alert::success('Your update was successfull.');
        }
    }

    // create navigation
    public function createNavigation(Post $post)
    {
        $this->table = 'navigation';

        if ($post->position == '')
        {
            $post->set('position', 1);
        }

        if ($this->insert($post->data())->ok)
        {
            Alert::success('Navigation added successfully');
        }
    }

    // delete navigation
    public function deleteNav(int $navigationid)
    {
        $this->table = 'navigation';

        if ($this->delete('navigationid = ?', $navigationid)->ok)
        {
            Alert::success('Navigation deleted successfully');
        }
    }

    // create plugin trigger
    public function callPluginMethods($plugin, $action, $id)
    {
        $model = createModelRule(function($body){ $body->allow_form_input(); });

        self::loadPluginConfiguration($action, $plugin, $model, $id);

        // push model to view
        dropbox('model', $model);
    }

    // load configuration
    private static function loadPluginConfiguration($action, $plugin, &$model=null)
    {
        // load configuration
        $plugin = call_user_func('\Installations\Plugins\\'.ucfirst($plugin).'\\'.ucfirst($plugin).'::config');

        // get methods
        $getMethod = isset($plugin[$action]) ? $plugin[$action] : false;

        // get arguments
        $args = func_get_args();
        
        // start from index 4
        $args = array_splice($args, 3);

        if ($model !== null)
        {
            // push model to the begining
            array_unshift($args, $model);
        }

        if (is_array($getMethod))
        {
            // get request method
            $http_method = $_SERVER['REQUEST_METHOD'];

            if (isset($getMethod[$http_method]))
            {
                $config = $getMethod[$http_method];

                // get arguments
                Bootloader::$instance->getParameters($config['class'], $config['method'], $const, $args);

                // call method
                call_user_func_array(['\\'.$config['class'], $config['method']], $const);
            }
        }
    }

    // process installation
    public function postInstall(Post $post)
    {
        $file = $post->files['install_file'];

        if ($file['error'] == 0)
        {
            // get filename
            $filename = $file['name'];

            // get extension
            $extension = extension($filename);

            // check extension
            if (strtolower($extension) == 'zip')
            {
                $zip = new \ZipArchive();
                // get temp diretory
                $temp = PATH_TO_STORAGE . 'Tmp/' . $filename;

                // move to tmp directory
                if (move_uploaded_file($file['tmp_name'], $temp))
                {
                    $zip->open($temp);
                    $zip->extractTo(CMS_ROOT . 'Installations/' . $post->installation_type);
                    $zip->close();

                    $post->set('installation_path', CMS_ROOT . 'Installations/' . $post->installation_type . '/' . $post->installation_title);
                }
            }

            // insert install
            if (db('installations')->insert($post->data())->ok)
            {
                Alert::success('Installation complete');
                
                // delete tmp file
                unlink($temp);
            }
        }
    }

    // add table configuration
    public function addTableConfig(Post $post)
    {
        // get identifier
        $identifier = $post->table_identifier;

        // add to table
        $success = false;

        foreach ($identifier as $index => $identifierName)
        {
            // insert to database
            $insert = [
                'table_identifier' => $identifierName,
                'table_linker' => $post->table_linker[$index],
                'table_json' => $post->table_json[$index]
            ];

            // add to table
            if (db('tables')->insert($insert)->ok)
            {
                $success = true;
            }
        }

        if ($success)
        {
            Alert::success('Table'.(count($identifier) > 1 ? 's' : '').' added successfully.' );
        }
    }

    // edit table
    public function editTableConfig($tableid, Post $post)
    {
        $model = createModelRule(function($body){ $body->allow_form_input(); });

        // get table information
        $tableInfo = db('tables')->get('tableid = ?', $tableid);

        if ($tableInfo->rows > 0)
        {
            $model->pushObject($tableInfo);
        }

        if ($post->has('table_identifier'))
        {
            $tableInfo->update($post->data());
            Alert::success('Table updated successfully.');
        }   

        dropbox('model', $model);
    }

    // create table record
    public function createTableRecord($table, Post $post)
    {
        if (!$post->isEmpty())
        {
            // get data
            $data = $post->data();

            $insert = []; // fresh array

            // run loop and extract column data
            $columnIndex = 0;

            foreach ($data as $column => $array)
            {
                foreach ($array as $index => $columnData)
                {
                    if ($columnData != '')
                    {
                        $insert[$index][$column] = $columnData;
                    }
                }
            }

            if (count($insert) > 0)
            {
                $db = db($table)->config([
                    'allowSlashes' => true,
                    'allowHTML' => true
                ]);

                $inserted = 0;

                foreach ($insert as $data)
                {
                    if ($db->insert($data)->ok)
                    {
                        $inserted++;
                    }
                }

                if ($inserted > 0)
                {
                    Alert::success('('.$inserted.') row'.(($inserted > 1) ? 's' : ''). ' inserted successfully.');
                }
            }
        }
    }

    // update table record
    public function updateTableRecord($table, Post $post, $action, $rowid)
    {
        if (!$post->isEmpty())
        {
            $db = db($table)->config([
                'allowSlashes' => true,
                'allowHTML' => true
            ]);

            // run update
            if ($db->update($post->data())->primary($rowid)->ok)
            {
                Alert::success('1 Row updated successfully.');
            }
        }
    }

    // delete table row
    public function deleteTableRow($table, $action, $rowid)
    {
        if ($table != null && $action == 'delete')
        {
            if (db($table)->delete()->primary($rowid)->ok)
            {
                Alert::success('1 Row deleted successfully.');
            }
        }
    }
}