<?php

namespace Core;

class Page
{
    private $layout;
    private $title;
    private $view;
    private $data;

    /**
     * Page constructor.
     *
     * @param  string  $layout
     * @param  string  $title
     * @param  string|null  $view
     * @param  array  $data
     */
    public function __construct(string $layout, $title = '', $view = null, array $data = [])
    {
        $this->layout = $layout;
        $this->title = $title;
        $this->view = $view;
        $this->data = $data;
    }

    public function __get($property)
    {
        return $this->$property;
    }
}