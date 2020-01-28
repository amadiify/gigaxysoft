<?php

/**
 * App Provider. Gets autoloaded with class
 * @package App provider
 */

class AppProvider extends App
{
    // request actions for views
    public $viewActions = 
    [
        'container' => [
            'create' => 'container/create',
            'edit' => 'container/edit'
        ],
        'images' => [
            'upload' => 'images/upload',
            'update' => 'images/update'
        ],
        'directives' => [
            'create' => 'directives/create',
            'edit' => 'directives/edit'
        ],
        'users' => [
            'create' => 'users/create',
            'edit' => 'users/edit'
        ],
        'pages' => [
            'edit-view' => 'pages/edit-view',
            'edit-nav' => 'pages/edit-nav',
            'create' => 'pages/create'
        ],
        'plugins' => [
            'create' => 'plugins/create',
            'edit' => 'plugins/edit'
        ],
        'tables' => [
            'edit' => 'tables/edit',
            'create' => 'tables/create'
        ]
    ];

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

    // get action view
    public function getActionView(string $viewModel, $action) : string
    {
        // check if actions exists for this view model
        if (isset($this->viewActions[$viewModel]) && !is_null($action))
        {
            // get view actions
            $viewActions = $this->viewActions[$viewModel];

            // check if action exists
            if (isset($viewActions[$action]))
            {
                // return action view
                return $viewActions[$action];
            }
        }

        return $viewModel;
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