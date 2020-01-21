<?php

/**
 * @package GetUsers Provider
 * @author Moorexa <moorexa.com>
 */

class UsersGetUsersProvider extends UsersProvider
{
    /**
     * @method getDidEnter
     * 
     * #called upon rendering GET request
     */
    public function getDidEnter()
    {
        
    }

    /**
     * @method getWillEnter
     * 
     * #called before rendering GET request
     */
    public function getWillEnter($next)
    {
        // route successful!
        $next();
    }
}