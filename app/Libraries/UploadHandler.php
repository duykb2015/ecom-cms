<?php

namespace App\Libraries;

class UploadHandler
{
    /**
     * Used to upload multiple images to server
     *
     * @param mixed $images Images to upload
     * @param string $name_from_input Name of input field
     * @return string|bool a string name of uploaded images or FALSE on failure
     */
    function multiple_images($images, $name_from_input = 'images')
    {
        $file_name = [];
        foreach ($images[$name_from_input] as $img) {
            if ($img->isValid() && !$img->hasMoved()) {
                $newName = $img->getRandomName();
                $file_name[] = $newName;
                $img->move(ROOTPATH . 'public\uploads', $newName);
            }
        }
        return json_encode($file_name);
    }

    /**
     * Used to remove unused images
     *
     * @param string $images json encode string of images name
     */
    function remove_images($images)
    {
        $images = json_decode($images);
        foreach ($images as $img) {
            $file = ROOTPATH . 'public/uploads/' . $img;
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }
}