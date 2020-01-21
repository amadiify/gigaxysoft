<?php

use Moorexa\Structure as Schema;

class Slides
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->increment('slideid');
        $schema->string('slide_title');
        $schema->string('slide_group')->default('homescreen');
        $schema->string('slide_image');
        $schema->string('slide_btn');
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
        $option->rename('slides'); // rename table
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
                    'slide_title' => 'smart city',
                    'slide_image' => 'Slides/slide1.jpg',
                    'slide_btn' => 'app/home'
                ]
            )->go();
        }
    }
}