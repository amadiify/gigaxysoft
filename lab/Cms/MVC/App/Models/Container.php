<?php
namespace Moorexa;

use Moorexa\DB;
use Moorexa\Event;
use Database\Query;
use Moorexa\HttpPost as Post;

/**
 * Container model class auto generated.
 *
 *@package	Container Model
 *@author  	Moorexa <www.moorexa.com>
 **/

class Container extends Model
{
    // @override table name
    public $table = "containers";

    // set request rule
    public $requestRule = [
        'createContainer' => 'POST',
        'editContainer'   => 'POST',
        'deleteContainer' => 'GET'
    ];

    // container rule
    public function setContainerRule($rule)
    {
        $rule->flag_required_if = 'post';

        $rule->container_name('string|notag|required|min:1');
        $rule->container_body('string|required|min:1');
    }

    // edit controller
    public function editContainer($containerid)
    {
        $rule = $this->useRule('ContainerRule');

        if ($rule->isOk())
        {
            $update = Query::updateContainer($rule->getData(), $containerid);

            if ($update->ok)
            {
                return true;
            }
        }

        return false;
    }

    // create container
    public function createContainer(Post $post)
    {
        $insert = [];
        $container_name = $post->container_name;
        $container_body = $post->container_body;

        foreach ($container_name as $index => $name)
        {
            $insert[] = [
                'container_name' => $name,
                'container_body' => $container_body[$index]
            ];
        }

        // rows inserted 
        $inserted = 0;

        if (count($insert) > 0)
        {
            foreach ($insert as $row => $containerData)
            {
                $push = Query::insertContainer($containerData);
                if ($push->ok)
                {
                    $inserted++;
                }
            }
        }

        return $inserted;
    }

    // delete container
    public function deleteContainer($containerid)
    {
        $delete = Query::deleteContainer($containerid);

        if ($delete->ok)
        {
            return true;
        }

        return false;
    }
    

    // render plain text
    public function renderPlain(string $text)
    {
        $cont = htmlentities($text, ENT_NOQUOTES, 'UTF-8');

        $cont = str_replace('&amp;#039;', "'", $cont);
        $cont = str_replace('&#039;', "'", $cont);

        return $cont;
    }
}