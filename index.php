<?php

require_once __DIR__ . '/vendor/autoload.php';

try {
    require_once __DIR__ . '/app/routes.php';

    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];
    echo $router->resolve($url, $method);
} catch (\Exception $e) {
    echo $e->getMessage();
}