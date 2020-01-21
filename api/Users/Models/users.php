<?php
namespace Model;

use Moorexa\ApiModel as ApiModel;

class Users extends ApiModel
{
    /**
    *
    * See documention https://www.moorexa.com/doc/api/model-setRules
    *
    * @param $body : make ready data to be used by this model
    * @return void
    **/

    public function setRules($body)
    {
        /* Options
         $body-><key> = <default value>;
         $body->username = 'hello';
         $body->username('<rule>', '<default>');
         $body->username('required|notag|min:2', 'moorexa');
        */
    }
}