<?php

/**
 * App Provider. Gets autoloaded with class
 * @package App provider
 */

class AppProvider extends App
{
    /**
     * @method Boot startup 
     * This method would be called upon startup
     */
    public function boot($next)
    {
       Moorexa\Rexa::preload('alert');
       
       // call route! Applies Globally.
       $next();
    }

    /**
     * @method onHomeInit  
     * This method would be called upon route request to App/home
     */
    public function onHomeInit($next)
    {
        // route passed!
        $next();
    }

    // you can register more init methods for your view models.
}