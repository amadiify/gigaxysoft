<?php

use Moorexa\Structure as Schema;

class Permission
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->increment('permissionid');
        $schema->string('permission');
        $schema->text('permission_group');
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
        $option->rename('permission'); // rename table
        $option->engine('innoDB'); // set table engine
        $option->collation('utf8_general_ci'); // set collation
    }

    // promise during migration
    public function promise($status, $db)
    {
        if ($status == 'complete')
        {
            $permissions = [
                [
                    'permission' => 'Basic Moderator',
                    'permission_group' => 'view'
                ],
                [
                    'permission' => 'Moderator',
                    'permission_group' => 'view,edit,update,upload'
                ],
                [
                    'permission' => 'Administrator',
                    'permission_group' => 'view,edit,update,delete,upload'
                ],
                [
                    'permission' => 'Super Adminstrator',
                    'permission_group' => 'view,edit,update,delete,upload,create,destroy'
                ]
            ];

            // add permissions
            foreach ($permissions as $permission)
            {
                $db->insert($permission)->go();
            }
        }
    }
}