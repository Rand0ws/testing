<?php

namespace App\Controllers;

class ErrorController extends Controller
{
    public function notFound()
    {
        $this->title = 'Страница не найдена';

        return $this->render('errors/404');
    }
}