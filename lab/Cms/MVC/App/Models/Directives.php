<?php
namespace Moorexa;

use Moorexa\DB;
use Moorexa\Event;
use Moorexa\HttpPost as Post;
use Bootstrap\Alert;

/**
 * Directives model class auto generated.
 *
 *@package	Directives Model
 *@author  	Moorexa <www.moorexa.com>
 **/

class Directives extends Model
{
    // create triggers
    public $triggers = [
        'directives' => [
            'delete' => 'get:deleteDirective',
            'edit'   => 'post:editDirective',
        ]
    ];

    // define request rule
    public $requestRule = [
        'createDirectives' => 'POST',
    ];

    // define directive rule
    public function setDirectiveRule($body)
    {
        $body->flag_required_if = 'post';
        
        $body->flags([
            'string' => 'string|notag|required|min:1'
        ]);

        $body->directive('@string');
        $body->directive_class('@string');
        $body->directive_method('@string');
    }

    // create directive
    public function createDirectives(Post $post)
    {
        $directive = $post->directive;

        // inserted 
        $inserted = 0;

        // add directive
        if (count($directive) > 0)
        {
            foreach ($directive as $index => $dd)
            {
                $insert = [
                    'directive' => $dd,
                    'directive_class' => $post->directive_class[$index],
                    'directive_method' => $post->directive_method[$index]
                ];

                // insert to database
                if (\Query::addDirective($insert)->ok)
                {
                    $inserted++;
                }
            }
        }

        return $inserted;
    }

    // edit directive
    public function editDirective($directiveid)
    {
        $post = $this->useRule('DirectiveRule');

        if ($post->isOk())
        {
            if (\Query::updateDirective($post->getData(), $directiveid)->ok)
            {
                return true;
            }
        }

        return false;
    }

    // delete directive
    public function deleteDirective($directiveid)
    {
        if (db('directives')->delete('directiveid = ?', $directiveid)->ok)
        {
            Alert::success('Directive deleted successfully.');
        }
    }
}