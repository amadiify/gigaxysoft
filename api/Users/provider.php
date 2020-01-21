<?php

/**
 * Users Provider. Gets autoloaded with class
 * @package Users provider
 */

class UsersProvider extends Users 
{
    /**
     * @method Boot startup 
     * This method would be called upon startup
     * Run 'php assist new ap <meth> <handler>/<route>' to generate a route provider
     * Example;
     * 'php assist new ap get users/profile'
     */

    public function boot($next)
    {
        // call route! Applies Globally.
        $next();
    }
}