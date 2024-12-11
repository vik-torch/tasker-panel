<?php

namespace Core\Route;

class Track implements ITrack
{
    public string $action;
    public string $controller;

    public function __construct($controller, $action)
    {
        $this->action = $action;
        $this->controller = $controller;
    }

    public function run(): string
    {
        $controller = new $this->controller();
        return $controller->{$this->action}();
    }
}