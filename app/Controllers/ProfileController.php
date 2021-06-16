<?php

namespace App\Controllers;

use App\Models\Image;

class ProfileController extends Controller
{
    public function index()
    {
        unset($_SESSION['errors']);

        if (!isset($_SESSION['user'])) {
            header('Location: /');
        }

        if (isset($_POST['downloadImage'])) {
            $this->saveImage();
        }

        if (isset($_POST['delete'])) {
            $this->deleteImage($_POST['delete']);
        }

        $this->title = 'Профиль';
        $image       = new Image(); // Создаём объект модели
        $images      = $image->getImages($_SESSION['user']['id']);

        foreach ($images as $k => $img) {
            $tmp = $this->processImage($img);

            $images[$k]['img2'] = $tmp;
        }

        return $this->render('profile/index', compact('images'));
    }

    public function saveImage()
    {
        $path  = time() . '_' . $_FILES['images']['name'];
        $types = ['image/jpeg', 'image/gif', 'image/png'];

        if (!in_array($_FILES['images']['type'], $types)) {
            $_SESSION['errors'][] = 'Недопустимый тип файла. Используйте формат jpg, gif или png';
        } elseif (!move_uploaded_file($_FILES['images']['tmp_name'], 'uploads/images/profile/' . $path)) {
            $_SESSION['errors'][] = 'Ошибка при загрузке изображения';
        } else {
            $image = new Image();
            $image->insertImage($_SESSION['user']['id'], $path);
        }
    }

    public function deleteImage($id)
    {
        $delete = new Image();
        $delete->deleteImage($id);
    }

    protected function processImage($image)
    {
        $filename = 'http://profile.loc/uploads/images/profile/' . $image['img'];

        $info   = getimagesize($filename);
        $width  = $info[0];
        $height = $info[1];
        $type   = $info[2];

        switch ($type) {
            case 1:
                $in = imagecreatefromgif($filename);
                break;
            case 2:
                $in = imagecreatefromjpeg($filename);
                break;
            case 3:
                $in = imagecreatefrompng($filename);
                break;
        }

        $new_weight = 100;
        $new_height = 100;

        $out = imagecreatetruecolor($new_weight, $new_height);
        imagecopyresampled($out, $in, 0, 0, 0, 0, $new_weight, $new_height, $width, $height);

        $new_name = 'uploads/images/profile/low/' . strtok($image['img'], '.') . '.jpg';
        imagejpeg($out, $new_name);

        return $new_name;
    }
}