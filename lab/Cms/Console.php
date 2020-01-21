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

        // ok call parent new method now
        parent::_new($arg);
    }
}