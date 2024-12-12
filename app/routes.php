<?php

use Core\Route\Router;
use App\Controllers\Controller;
use App\Controllers\HelloController;
use App\Controllers\FirstController;

/**
 * Файл с добавлением роутов
 */

$router = new Router();

$router->addRoute('GET', '/', HelloController::class, 'index');
$router->addRoute('GET', '/test', FirstController::class, 'index');