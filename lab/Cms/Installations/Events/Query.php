<?php

namespace Installations\Plugins\Events;
use Bootstrap\Alert;
use Moorexa\HttpPost as Post;

class Query extends Events
{
    // get queries
    public static function getEvents(int $maxFetch = 1000)
    {
        // get table name
        $table = parent::$tables['default'];

        // return fetch row
        return db($table)->get()->orderby('eventid', 'desc')->limit(0, $maxFetch);
    }

    // add event
    public static function addNewEvent($model, Post $post)
    {
        $eventImage = $post->files['event_image'];

        if ($eventImage['error'] == 0)
        {
            $destination = EVENTS_PLUGIN_BASE . 'Images/' . md5($eventImage['name']) . $eventImage['name'];

            // upload file
            if (move_uploaded_file($eventImage['tmp_name'], $destination))
            {
                $model->event_image = $destination;
            }
        }

        // add event now
        $model->table = parent::$tables['default'];

        if ($model->create())
        {
            Alert::success('Event created successfully');
            $model->clear();
        }

    }

    // fetch event
    public static function fetchEvent($model, $id)
    {
        // get table name
        $table = parent::$tables['default'];

        $get = db($table)->get('eventid = ?', $id);

        $model->pushObject($get);
    }

    // add event
    public static function updateEvent($model, $id, Post $post)
    {
        $eventImage = $post->files['event_image'];

        if ($eventImage['error'] == 0)
        {
            $destination = EVENTS_PLUGIN_BASE . 'Images/' . md5($eventImage['name']) . $eventImage['name'];

            // upload file
            if (move_uploaded_file($eventImage['tmp_name'], $destination))
            {
                $model->event_image = $destination;
            }
        }

        // add event now
        $model->table = parent::$tables['default'];
        $model->eventid = $id; // set id

        if ($model->update())
        {
            Alert::success('Event updated successfully');
        }

    }

    // delete event
    public static function deleteEvent($model, $id)
    {
        $table = parent::$tables['default'];

        if (db($table)->delete('eventid = ?', $id)->ok)
        {
            Alert::success('Event deleted successfully');
        }
    }
}