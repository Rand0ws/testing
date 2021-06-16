<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
    public function login($login, $password)
    {
        $user = $this->checkUser($login, $password);

        if ($user === null) {
            $_SESSION['errors'][] = 'Вы ввели неверный логин или пароль';
        }

        return $user;
    }

    public function insertUser($login, $password)
    {
        $this->insert("INSERT INTO `users` SET `login` = '$login', `password` = '$password'");
    }

    public function checkUser($login, $password)
    {
        return $this->findOne("SELECT id, login FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
    }

    public function checkLogin($login)
    {
        return $this->findOne("SELECT id, login FROM `users` WHERE `login` = '$login'");
    }
}