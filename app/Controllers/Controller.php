<?php

namespace App\Controllers;

use \Core\Controller\Controller as BaseController;

class Controller extends BaseController
{
    public function index(): string
    {
        return 'Hello World';
    }
}