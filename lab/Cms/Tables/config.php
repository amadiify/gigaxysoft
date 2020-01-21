<?php

use Moorexa\Structure as Schema;

class Config
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->increment('configid');
        $schema->string('sitename');
        $schema->string('default_controller');
        $schema->string('default_view');
        $schema->string('favicon');
        $schema->text('keywords');
        $schema->text('description');
        $schema->string('developer');
        $schema->string('siteid');
        // and more.. 
    }

    // drop table
    public function down($drop, $record)
    {
        // $record carries table rows if exists.
        // execute drop table command
        $drop();
    }

    // options
    public function option($option)
    {
        $option->rename('config'); // rename table
        $option->engine('innoDB'); // set table engine
        $option->collation('utf8_general_ci'); // set collation
    }

    // promise during migration
    public function promise($status, $db)
    {
        if ($status == 'complete')
        {
            // do some cool stuffs.
            $db->insert(
                [
                    'sitename' => 'Welcome to ABRDI',
                    'default_controller' => 'App',
                    'default_view' => 'home',
                    'favicon' => 'CMS/favicon.png',
                    'keywords' => '',
                    'description' => '',
                    'developer' => 'ABRDI Team'
                ]
            )->go();
        }
    }
}