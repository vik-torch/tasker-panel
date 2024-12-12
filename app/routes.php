<?php

use Core\Route\Router;
use App\Controllers\HelloController;
use App\Controllers\FirstController;
use App\Controllers\TestController;

/**
 * Файл с добавлением роутов
 */

$router = new Router();

$router->addRoute('GET', '/', HelloController::class, 'index');

$router->addRoute('GET', '/test', TestController::class, 'index');
$router->addRoute('GET', '/test/first', TestController::class, 'findFirst');