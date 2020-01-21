<?php

namespace Installations\Plugins\Gallery;
use Moorexa\DB\Table;

class Gallery
{
    // app tables
    protected static $tables = [
        'default' => 'PhotoBoot'
    ];

    public static function init()
    {
        // application entry
        // inject directives
        boot()->get(\Moorexa\Directive::class)->inject(Directives::class);

        // run create sql
        self::galleryTable();
    }

    // load configuration
    public static function config() : array
    {
        return [
            'view' => GALLERY_PLUGIN_BASE . 'Views/',
            'create' => [
                'POST' => ['class' => Query::class, 'method' => 'addNewImage']
            ],
            'edit' => [
                'GET'  => ['class' => Query::class,  'method' => 'fetchImage'],
                'POST' => ['class' => Query::class,  'method' => 'updateImage']
            ],
            'delete' => [
                'GET' => ['class' => Query::class, 'method' => 'deleteImage']
            ]
        ];
    }

    // create event table
    public static function galleryTable()
    {
        Table::create(self::$tables['default'], function($schema)
        {
            $schema->increment('imageid');
            $schema->string('image_name');
            $schema->text('image_caption');
            $schema->string('image');
            $schema->datetime('date_created')->current();
            $schema->string('publish');
            $schema->string('siteid');
        });
    }
}