<?php

use Core\Route\Router;
use App\Controllers\HelloController;
use App\Controllers\FirstController;
use App\Controllers\TestController;
use App\Controllers\Task\GetController;
use App\Controllers\Task\StoreController;

/**
 * Файл с добавлением роутов
 */

$router = new Router();

$router->addRoute('GET', '/', HelloController::class, 'index');
$router->addRoute('GET', '/first', FirstController::class, 'index');

$router->addRoute('GET', '/test', TestController::class, 'index');
$router->addRoute('GET', '/test/first', TestController::class, 'findFirst');

////////
// Task
////////
$router->addRoute('GET', '/task', GetController::class, 'index');
$router->addRoute('POST', '/task/store', StoreController::class, 'index');