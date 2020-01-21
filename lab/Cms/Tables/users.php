<?php

use Moorexa\Structure as Schema;

class Users
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->increment('userid');
        $schema->bigint('permissionid')->default(1);
        $schema->string('username');
        $schema->string('password');
        $schema->string('fullname');
        $schema->bigint('createdby')->default(0);
        $schema->datetime('dateadded')->current();
        $schema->string('loggedinToken');
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
        $option->rename('users'); // rename table
        $option->engine('innoDB'); // set table engine
        $option->collation('utf8_general_ci'); // set collation
    }

    // promise during migration
    public function promise($status, $db)
    {
        if ($status == 'complete')
        {
            // do some cool stuffs.
            $db->insert([
                'username' => 'admin',
                'password' => \Moorexa\Hash::digest('1234'),
                'fullname' => 'John Duo',
                'permissionid' => 4,
                'siteid' => boot()->singleton('CmsGlobal\Cms')->siteID
            ])->go();
        }
    }
}