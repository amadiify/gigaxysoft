<?php

/**
 * @package Godoit Extended Assist CLI Helper Commands
 * @author  Moorexa Software Foundation
 */

class Console extends Assist
{
    // commands
    public static $commands = [
        'help' => 'Shows a help screen for Godoit.'
    ];

    // command help
    public static $commandHelp = [
        'help' => [
            'info' => 'Shows a help screen for Godoit.'
        ]
    ];

    // help command definition
    public static function help()
    {
        // display something simple
        self::out('You have reached the help screen for Godoit.');

        // you can also trigger the help method from the parent class
        // => parent::help($arg);

        // you should register this CLI Helper file in kernel/assist.php before use.
    }

    // more static methods.. 
    public static function _new($arg)
    {
        // change controller base path
        parent::$controllerBasePath = HOME . 'lab/Cms/MVC';

        // change table base path
        parent::$tablePath = 'Tables/';

        // ok call parent new method now
        parent::_new($arg);
    }

    // migrate command 
    public static function migrate($arg)
    {
        parent::$assistPath = HOME;
        
        // apply from
        array_push($arg, '-from='.HOME.'lab/Cms/Tables/', '-prefix=Zema_');

        // add save query path
        Moorexa\DB::$queryCachePath = HOME . 'lab/Cms/Database/QueryStatements.php';

        // call migrate method
        parent::migrate($arg);
    }
}