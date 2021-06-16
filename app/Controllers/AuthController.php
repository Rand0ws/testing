<?php

namespace App\Controllers;

use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        unset($_SESSION['errors']);

        if (isset($_SESSION['user'])) {
            header('Location: /profile');
        }

        $this->title = 'Аутентификация';

        if (isset($_POST['auth'])) {
            $this->login();
        }

        if (isset($_POST['registration'])) {
            $this->registration();
        }

        if (!empty($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
        }

        return $this->render('auth/index');
    }

    public function login()
    {
        if (empty($_POST['login']) || iconv_strlen($_POST['login']) < 3) {
            $_SESSION['errors'][] = 'Вы не ввели логин или он состоит меньше чем из 3 символов';
        }

        if (empty($_POST['password']) || iconv_strlen($_POST['password']) < 6) {
            $_SESSION['errors'][] = 'Вы не ввели пароль или он состоит меньше чем из 6 символов';
        }

        $user = new User();
        $user = $user->login($_POST['login'], $_POST['password']);

        if ($user) {
            $_SESSION['user'] = $user;
            header('Location: /profile');
        }
    }

    public function registration()
    {
        if (empty($_POST['login']) || iconv_strlen($_POST['login']) < 3) {
            $_SESSION['errors'][] = 'Вы не ввели логин или он состоит меньше чем из 3 символов';
        }

        if (empty($_POST['password']) || iconv_strlen($_POST['password']) < 6) {
            $_SESSION['errors'][] = 'Вы не ввели пароль или он состоит меньше чем из 6 символов';
        }

        if (empty($_POST['confirm_password'])) {
            $_SESSION['errors'][] = 'Вы не ввели подтверждение пароля';
        }

        if (!empty($_POST['password']) && !empty($_POST['confirm_password']) && $_POST['password'] !== $_POST['confirm_password']) {
            $_SESSION['errors'][] = 'Пароли не совпадают';
        }

        $user = new User();
        $checkUser = $user->checkLogin($_POST['login']);

        if ($checkUser) {
            $_SESSION['errors'][] = 'Такой логин уже используется';
        }

        if (!$checkUser) {
            $user->insertUser($_POST['login'], $_POST['password']);

            $_SESSION['success'] = 'Вы успешно зарегистрировались';
        }
    }
}