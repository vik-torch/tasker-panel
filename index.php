<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Core\Route\Router;

require_once __DIR__ . '/vendor/autoload.php';

try {
    $router = new Router();
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];
    echo $router->resolve($url, $method);
} catch (\Exception $e) {
    echo $e->getMessage();
}