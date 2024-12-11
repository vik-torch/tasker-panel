<?php

use Core\Route\Router;
use App\Controllers\Controller;
use App\Controllers\FirstController;

/**
 * Файл с добавлением роутов
 */

$router = new Router();

$router->addRoute('GET', '/', Controller::class, 'index');
$router->addRoute('GET', '/first', FirstController::class, 'index');