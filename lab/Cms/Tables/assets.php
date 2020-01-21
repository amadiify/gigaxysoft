<?php

use Moorexa\Structure as Schema;

class Assets
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->increment('assetid');
        $schema->string('path');
        $schema->string('tag')->default('css');
        $schema->tinyint('visible')->default(true);
        $schema->int('position')->default(1);
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
        $option->rename('assets'); // rename table
        $option->engine('innoDB'); // set table engine
        $option->collation('utf8_general_ci'); // set collation
    }

    // promise during migration
    public function promise($status, $db)
    {
        if ($status == 'complete')
        {
            // do some cool stuffs.
            $assets = [
                [
                    'path' => 'moorexa.css'
                ],
                [
                    'path' => 'moorexa.min.js',
                    'tag' => 'js'
                ],
                [
                    'path' => 'theme/vendor.bundle.css?ver=141'
                ],
                [
                    'path' => 'theme/style.css?ver=141'
                ],
                [
                    'path' => 'theme/theme.css?ver=141'
                ],
                [
                    'path' => 'theme/jquery.bundle.js?ver=141',
                    'tag' => 'js'
                ],
                [
                    'path' => 'theme/scripts.js?ver=141',
                    'tag' => 'js'
                ]
            ];

            foreach ($assets as $asset)
            {
                $db->insert($asset)->go();
            }
        }
    }
}