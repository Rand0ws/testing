<?php

namespace Core;

class Track
{
    private $controller;
    private $action;
    private $params;

    /**
     * Track constructor.
     *
     * @param  string  $controller
     * @param  string  $action
     * @param  array  $params
     */
    public function __construct(string $controller, string $action, array $params = [])
    {
        $this->controller = $controller;
        $this->action = $action;
        $this->params = $params;
    }

    /**
     * @param $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        return $this->$property;
    }
}