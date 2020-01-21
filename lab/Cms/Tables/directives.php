<?php

use Moorexa\Structure as Schema;

class Directives
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->increment('directiveid');
        $schema->string('directive');
        $schema->string('directive_class');
        $schema->string('directive_method');
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
        $option->rename('directives'); // rename table
        $option->engine('innoDB'); // set table engine
        $option->collation('utf8_general_ci'); // set collation
    }

    // promise during migration
    public function promise($status, $db)
    {
        if ($status == 'complete')
        {
            $db->config(
            [
                'allowSlashes' => true
            ]
            )->insert(
            [
                'directive' => 'image',
                'directive_class' => 'CmsGlobal\Cms',
                'directive_method' => 'loadImages'
            ],
            [
                'directive' => 'breacum-title',
                'directive_class' => 'CmsGlobal\Cms',
                'directive_method' => 'loadBreadcumTitle'
            ],
            [
                'directive' => 'goto',
                'directive_class' => 'CmsGlobal\Cms',
                'directive_method' => 'gotoDirective'
            ])->go();
        }
    }
}