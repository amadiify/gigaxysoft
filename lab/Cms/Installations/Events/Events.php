<?php

namespace Installations\Plugins\Events;
use Moorexa\DB\Table;

class Events
{
    // app tables
    protected static $tables = [
        'default' => 'Events'
    ];

    public static function init()
    {
        // application entry
        // inject directives
        boot()->get(\Moorexa\Directive::class)->inject(Directives::class);

        // run create sql
        self::eventTable();
    }

    // load configuration
    public static function config() : array
    {
        return [
            'view' => EVENTS_PLUGIN_BASE . 'Views/',
            'create' => [
                'POST' => ['class' => Query::class, 'method' => 'addNewEvent']
            ],
            'edit' => [
                'GET' => ['class' => Query::class, 'method' => 'fetchEvent'],
                'POST' => ['class' => Query::class, 'method' => 'updateEvent']
            ],
            'delete' => [
                'GET' => ['class' => Query::class, 'method' => 'deleteEvent']
            ]
        ];
    }

    // create event table
    public static function eventTable()
    {
        Table::create(self::$tables['default'], function($schema)
        {
            $schema->increment('eventid');
            $schema->string('event_title');
            $schema->text('event_body');
            $schema->string('event_date');
            $schema->datetime('date_created')->current();
            $schema->string('event_image');
            $schema->string('event_button');
            $schema->string('siteid');
        });
    }

    // add event
}