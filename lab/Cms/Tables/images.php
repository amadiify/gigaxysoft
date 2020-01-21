<?php

use Moorexa\Structure as Schema;

class Images
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->increment('imageid');
        $schema->string('image_path');
        $schema->string('alt');
        $schema->string('title');
        $schema->string('image_name');
        $schema->string('siteid');
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
        $option->rename('images'); // rename table
        $option->engine('innoDB'); // set table engine
        $option->collation('utf8_general_ci'); // set collation
    }

    // promise during migration
    public function promise($status, $db)
    {
        if ($status == 'complete')
        {
            $db->insert(
            [
                'image_path' => 'CMS/ABRDI-Logo.png',
                'image_name' => 'app-logo'
            ],
            [
                'image_path' => 'CMS/mmexport1543478758695.jpg',
                'image_name' => 'we-believe'
            ],
            [
                'image_path' => 'CMS/better-roads.png',
                'image_name' => 'home-banner'
            ])->go();
        }
    }
}