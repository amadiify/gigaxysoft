<?php 

use Moorexa\DB;
use Moorexa\Middleware;
use Component\Http;

/**
 * Users documentation can be added in documentation/
 *
 *@package	Users REST Api Class 
 *@author  	Moorexa <www.moorexa.com>
 *@endpoint www.example.com/users
 **/

class Users extends ApiManager
{
    // Users.request.table
    public $table = 'users';

    // Users.request.db 
    public $switchdb = null; // use default 
    
	/**
    *
    * See documention https://www.moorexa.com/doc/api
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/
    public function getUsers()
	{
        /*
         * @example; 
         * GET /users
         * GET /users/1
         */

        // outputs a json encoded data
		$this->status('success')->message('Users GET request added.');
	}

    /**
    *
    * See documention https://www.moorexa.com/doc/api
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/
    public function postUsers()
	{
        /*
         * @example; 
         * POST /users
         * POST /users/1
         */

        // outputs a json encoded data
		$this->status('success')->message('Users POST request added.');
	}

    /**
    *
    * See documention https://www.moorexa.com/doc/api
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/
    public function putUsers()
	{
        /*
         * @example; 
         * PUT /users
         * PUT /users/1
         */

        // outputs a json encoded data
		$this->status('success')->message('Users PUT request added.');
	}

    /**
    *
    * See documention https://www.moorexa.com/doc/api
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/
    public function deleteUsers()
	{
        /*
         * @example; 
         * DELETE /users
         * DELETE /users/1
         */

        // outputs a json encoded data
		$this->status('success')->message('Users DELETE request added.');
	}
}
// End here