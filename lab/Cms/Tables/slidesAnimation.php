<?php

use Moorexa\Structure as Schema;

class SlidesAnimation
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->increment('slidesAnimationid');
        $schema->bigint('slideid');
        $schema->string('content');
        $schema->string('contentWrapper');
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
        $option->rename('slidesAnimation'); // rename table
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
                    'slideid' => 1,
                    'content' => 'Crafting Digital Experience to help brands grow',
                    'contentWrapper' => '<h1 class="banner-heading animate t-u" data-animate="fade-in-up" data-delay="0.5" data-duration="0.5">{content}</h1>'
                ],

                [
                    'slideid' => 1,
                    'content' => 'The digital agency with a human approach',
                    'contentWrapper' => '<p class="lead lead-lg animate" data-animate="fade-in-up" data-delay="0.12" data-duration="0.5">{content}</p>'
                ],

                [
                    'slideid' => 1,
                    'content' => 'Check Out Our Work',
                    'contentWrapper' => '<div class="banner-btn animate" data-animate="fade-in-up" data-delay="0.20" data-duration="0.9">
                        <a href="{slide_btn}" class="menu-link btn">{content}</a>
                    </div>'
                ]
            )->allowHTML()->go();
        }
    }
}