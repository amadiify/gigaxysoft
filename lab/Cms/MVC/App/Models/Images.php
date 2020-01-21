<?php
namespace Moorexa;

use Moorexa\DB;
use Moorexa\Event;
use Moorexa\HttpPost as Post;

/**
 * Images model class auto generated.
 *
 *@package	Images Model
 *@author  	Moorexa <www.moorexa.com>
 **/

class Images extends Model
{
    // apply request rule
    public $requestRule = [
        'uploadImages' => 'POST'
    ];

    // request trigger
    public $triggers = [
        'images' => ['update' => 'post:updateImage']
    ];

    // upload images
    public function uploadImages(Post $post)
    {
        // get all files
        $files = $post->files['image_path'];

        // get file names
        $file_names = $files['name'];

        // get tmp path
        $tmp_file = $files['tmp_name'];

        // insert images array
        $images = [];

        if (count($file_names) > 0)
        {
            foreach ($file_names as $index => $filename)
            {
                // get tmp path to this file
                $tmpPath = $tmp_file[$index];

                // error
                $error = $files['error'][$index];

                if ($error == 0)
                {
                    $destination = APP_PATH . 'Uploads/' . md5($post->image_name[$index]) . $filename;

                    if (move_uploaded_file($tmpPath, $destination))
                    {
                        $images[] = [
                            'image_path' => $destination,
                            'image_name' => $post->image_name[$index]
                        ];
                    }
                }
            }
        }

        // inserted
        $inserted = 0;

        if (count($images) > 0)
        {
            foreach ($images as $index => $image)
            {
                $insert = \Query::addImageToDatabase($image);

                if ($insert->ok)
                {
                    $inserted++;
                }
            }
        }

        return $inserted;
    }

    // update image
    public function updateImage(Post $post, $imageid)
    {
        // get image
        $image = \Query::getSingleImage($imageid);

        if ($image->rows > 0)
        {   
            // get image from post
            $postImage = $post->files['image_path'];

            if ($postImage['error'] == 0)
            {
                // build destination
                $destination = APP_PATH . 'Uploads/' . md5($post->image_name) . $postImage['name'];

                // upload image
                if (move_uploaded_file($postImage['tmp_name'], $destination))
                {
                    if (file_exists($image->image_path) && $image->image_path != $destination)
                    {
                        // delete previous image
                        @unlink($image->image_path);
                    }

                    // update image in database
                    \Query::updateImage([
                        'image_path' => $destination,
                        'image_name' => $post->image_name
                    ], $imageid);

                    // all done!
                    return true;
                }
            }
        }

        // failed!
        return false;
    }
}