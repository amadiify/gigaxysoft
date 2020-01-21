<?php

use Moorexa\Structure as Schema;

class Navigation
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->increment('navigationid');
        $schema->string('page_name');
        $schema->string('page_link');
        $schema->int('navigationtypeid');
        $schema->tinyint('visible')->default(true);
        $schema->int('position')->default(1);
        $schema->bigint('parentid')->default(0);
        $schema->string('keyword');
        $schema->text('description');
        $schema->string('page_title');
        $schema->string('breadcum_title');
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
        $option->rename('navigation'); // rename table
        $option->engine('innoDB'); // set table engine
        $option->collation('utf8_general_ci'); // set collation
    }

    // promise during migration
    public function promise($status, $db)
    {
        if ($status == 'complete')
        {
            // do some cool stuffs.
            $pages = [
                [
                    'page_name' => 'Home',
                    'page_link' => 'app/home',
                    'navigationtypeid' => 1,
                    'breadcum_title' => 'Welcome'
                ],
                [
                    'page_name' => 'About',
                    'page_link' => 'app/about',
                    'navigationtypeid' => 1,
                    'breadcum_title' => 'About us',
                    'page_title' => 'About ABRDI',
                    'keyword' => 'about abrdi, About ABRDI'
                ],
                [
                    'page_name' => 'Focus',
                    'page_link' => 'app/focus',
                    'navigationtypeid' => 1,
                    'breadcum_title' => 'Our Focus',
                    'page_title' => 'ABRDI Focus',
                    'keyword' => 'ABRDI focus, abrdi focus, our focus'
                ],
                [
                    'page_name' => 'Gallery',
                    'page_link' => 'app/gallery',
                    'navigationtypeid' => 1,
                    'breadcum_title' => 'Our Gallery',
                    'page_title' => 'ABRDI Gallery',
                    'keyword' => 'ABRDI Gallery, Gallery'
                ],
                [
                    'page_name' => 'Project',
                    'page_link' => 'app/project',
                    'navigationtypeid' => 1,
                    'breadcum_title' => 'Our Projects',
                    'page_title' => 'ABRDI Projects',
                    'keyword' => 'ABRDI Projects, ABRDI project'
                ],
                [
                    'page_name' => 'Contact',
                    'page_link' => 'app/contact',
                    'navigationtypeid' => 1,
                    'breadcum_title' => 'Contact us',
                    'page_title' => 'Contact ABRDI',
                    'keyword' => 'Contact ABRDI, contact abrdi'
                ]
            ];

            foreach ($pages as $page)
            {
                $db->insert($page)->go();
            }
        }
    }
}