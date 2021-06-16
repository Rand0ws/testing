<?php

namespace Core;

class Controller
{
    protected $layout = 'default';
    public $title;

    protected function render($view, $data = [])
    {
        return new Page($this->layout, $this->title, $view, $data);
    }
}