<?php
namespace Moorexa;

use Moorexa\DB;
use Moorexa\Event;
use Moorexa\HttpPost as Post;
use Bootstrap\Alert;

/**
 * App model class auto generated.
 *
 *@package	App Model
 *@author  	Moorexa <www.moorexa.com>
 **/

class App extends Model
{
    // @override table name
    public $table = "";

    // @override connection. switch database 
    public $switchdb = "";

    // set up database structure
    public function up($schema)
    {
        //. code here
    }

    // post method
    public function sendContactMessage(Post $post)
    {
        $this->table = 'Gigaxy_contact';

        // insert data
        if ($this->insert($post->data())->ok)
        {
            Alert::success('Thank you for contacting us. We would get back to you soon!');
        }
    }

    // add services
    public function addServices(string $text)
    {
        $text = strtolower($text);

        $text = preg_replace('/(service|services)$/', '', $text);

        return $text . ' services';
    }

    // get services
    public function getServices(string $serviceGroup)
    {
        $this->table = 'Gigaxy_serviceGroups';

        $group = $this->get('serviceGroup = ?', $serviceGroup);

        // get services
        $services = $group->from('Gigaxy_services', 'serviceGroupid')->get();

        // return services
        return $services;
    }
}