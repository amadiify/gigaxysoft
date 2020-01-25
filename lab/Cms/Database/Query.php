<?php
namespace Database;
use Moorexa\DBPromise as promise;

/**
 * @package Wrap all queries to our database
 * @author Wekiwork creative lab
 */

class Query
{
    // Constants
    const YES = true;
    const NO = false;


    // get assets
    public static function getAssets() : promise
    {
        return db('assets')->get();
    }

    // get configs
    public static function getConfig() : promise
    {
        return db('config')->get();
    }

    // get navigation by link
    public static function getNavigationByLink(string $link) : promise
    {
        return db('navigation')->get('page_link=?', $link);
    }

    // get all parent navigation
    public static function getParentNavigation() : promise
    {
        return db('navigation')->get('parentid=?')->bind(0);
    }

    // check if parent nav has children
    public static function doesAssertTrueForNavWithChildren(int $parentid) : bool
    {
        // check here
        $checkForChildren = self::getParentNavChildren($parentid);

        if ($checkForChildren->rows > 0)
        {
            return Self::YES;
        }

        return Self::NO;
    }

    // get children to a parent navigation
    public static function getParentNavChildren(int $parentid) : promise
    {
        return db('navigation')->get('parentid=?', $parentid);
    }

    // get all directives
    public static function getAllDirectives()
    {
        return db('directives')->allowSlashes()->get();
    }

    // get all images
    public static function getAllImages() : array
    {
        $images = [];

        db('images')->get()->obj(function($row) use (&$images){
            $images[$row->image_name] = image($row->image_path);
        });

        return $images;
    }

    // get container row for an ID
    public static function getContainer(int $containerid)
    {
        return db('containers')->get('containerid=?')->bind($containerid);
    }

    // get containers
    public static function getContainers()
    {
        return db('containers')->get()->orderby('containerid', 'desc');
    }

    // update container
    public static function updateContainer($data, int $containerid)
    {
        return db('containers')
        ->config([
            'allowSlashes' => true,
            'allowHTML' => true
        ])
        ->update($data)->where('containerid=?', $containerid)->go();
    }

    // insert container
    public static function insertContainer(array $container)
    {
        return db('containers')
        ->config([
            'allowSlashes' => true,
            'allowHTML' => true
        ])->insert($container)->go();
    }

    // delete container
    public static function deleteContainer(int $containerid)
    {
        return db('containers')->delete('containerid=?', $containerid);
    }

    // add image
    public static function addImageToDatabase(array $imageArray)
    {
        return db('images')->insert($imageArray)->go();
    }

    // get a single image
    public static function getSingleImage(int $imageid)
    {
        return db('images')->get('imageid=?', $imageid);
    }

    // get a single directive
    public static function getSingleDirective(int $directiveid)
    {
        return db('directives')->allowSlashes()->get('directiveid=?', $directiveid);
    }

    // update image
    public static function updateImage(array $imageArray, int $imageid)
    {
        return db('images')->update($imageArray)->where('imageid=?', $imageid)->go();
    }

    // add directive
    public static function addDirective(array $directive)
    {
        return db('directives')->allowSlashes()->insert($directive)->go();
    }

    // update directive
    public static function updateDirective(array $directive, int $directiveid)
    {
        return db('directives')->allowSlashes()->update($directive, 'directiveid=?')->bind($directiveid);
    }

    // get user
    public static function getUser(int $userid)
    {
        return db('users')->get('userid=?', $userid);
    }

    // get user data from session
    public static function getUserDataFromSession()
    {
        static $userData;

        if (is_null($userData))
        {
            $userData = self::getUser(session()->get('zema.user.id'));
        }

        return $userData;
    }

    public function queryApplyPermissonId($query)
    {
        return $query->from('permission', 'permissionid')->get();
    }   

    // get user permisson group from session
    public static function getUserPermissionGroupFromSession()
    {
        static $group;

        if (is_null($group))
        {
            // get user data
            $permission = self::getUserDataFromSession()->query('ApplyPermissonId');
            $group = explode(',', $permission->permission_group);
        }

        return $group;
    }

    // get user permission
    public static function getUserPermissionFromSession()
    {
        static $permission;

        if (is_null($permission))
        {
            $permission = self::getUserDataFromSession()->query('ApplyPermissonId');
            $permission = $permission->permission;
        }

        return $permission;
    }

    // get navigation
    public static function getNavigation()
    {
        return db('navigation')->get()->orderby('navigationid','desc');
    }

    // get navigation by id
    public static function getNavigationById(int $navigationid)
    {
        return db('navigation')->get('navigationid = ?', $navigationid);
    }

    // get all plugins
    public static function getPlugins()
    {
        return db('installations')->get('installation_type=?', 'Plugins');
    }

    // get all tables
    public static function getTables()
    {
        return db('tables')->get();
    }

    // get table from linker
    public static function getTableByLinker(string $tableName)
    {
        return db('tables')->get('table_linker = ?', $tableName);
    }

    // get table row
    public static function getTableRows(string $tableName)
    {
        return db($tableName)->get()->orderbyprimarykey('desc');
    }
}