<?php

use Moorexa\Structure as Schema;

class Navigationtypes
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->increment('navigationtypeid');
        $schema->string('navigationtype');
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
        $option->rename('navigationtypes'); // rename table
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
                ['navigationtype' => 'public'],
                ['navigationtype' => 'admin']
            )->go();
        }
    }
}