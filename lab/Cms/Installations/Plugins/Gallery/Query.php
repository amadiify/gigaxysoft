<?php

namespace Installations\Plugins\Gallery;
use Bootstrap\Alert;
use Moorexa\HttpPost as Post;

class Query extends Gallery
{
    // get queries
    public static function getImages(int $maxFetch = 1000)
    {
        // get table name
        $table = parent::$tables['default'];

        // return fetch row
        return db($table)->get()->orderby('imageid', 'desc')->limit(0, $maxFetch);
    }

    // add event
    public static function addNewImage($model, Post $post)
    {
        $galleryImage = $post->files['image'];

        if ($galleryImage['error'] == 0)
        {
            $destination = GALLERY_PLUGIN_BASE . 'Images/' . md5($galleryImage['name']) . $galleryImage['name'];

            // upload file
            if (move_uploaded_file($galleryImage['tmp_name'], $destination))
            {
                $model->image = $destination;
            }
        }

        // add event now
        $model->table = parent::$tables['default'];

        if ($model->create())
        {
            Alert::success('Image uploaded successfully');
            $model->clear();
        }

    }

    // fetch event
    public static function fetchImage($model, $id)
    {
        // get table name
        $table = parent::$tables['default'];

        $get = db($table)->get('imageid = ?', $id);

        $model->pushObject($get);
    }

    // add event
    public static function updateImage($model, $id, Post $post)
    {
        $galleryImage = $post->files['image'];

        if ($galleryImage['error'] == 0)
        {
            $destination = GALLERY_PLUGIN_BASE . 'Images/' . md5($galleryImage['name']) . $galleryImage['name'];

            // upload file
            if (move_uploaded_file($galleryImage['tmp_name'], $destination))
            {
                $model->image = $destination;
            }
        }

        // add event now
        $model->table = parent::$tables['default'];
        $model->imageid = $id; // set id

        if ($model->update())
        {
            Alert::success('Image updated successfully');
        }

    }

    // delete event
    public static function deleteImage($model, $id)
    {
        $table = parent::$tables['default'];

        if (db($table)->delete('imageid = ?', $id)->ok)
        {
            Alert::success('Image deleted successfully');
        }
    }
}