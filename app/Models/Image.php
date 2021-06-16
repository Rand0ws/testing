<?php

namespace App\Models;

use Core\Model;

class Image extends Model
{
    public function getImages($id)
    {
        return $this->findMany("SELECT * FROM `images` WHERE `user_id` = '$id' ORDER BY `id` DESC");
    }

    public function insertImage($id, $path)
    {
        $this->sql("INSERT INTO `images` SET `user_id` = '$id', `img` = '$path'");
    }

    public function deleteImage($id)
    {
        $this->sql("DELETE FROM `images` WHERE `id` = '$id'");
    }
}