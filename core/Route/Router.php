<?php

namespace Core\Route;

class Router
{
    /**
     * Массив роутов
     *
     * @var array
     */
    protected $routes = [];

    public function __construct()
    {
        $routes = [
            'GET' => [
                '/' => [\App\Controllers\Controller::class, 'index'],
            ],
            'POST' => [
                
            ]
        ];

        foreach ($routes as $method => $uri) {
            foreach ($uri as $uri => $controller_info) {
                $this->addRoute($method, $uri, $controller_info[0], $controller_info[1]);
            }
        }
    }

    public function addRoute(
        string $method,
        string $uri,
        string $controller,
        string $action
    ) {
        $this->routes[$method][$uri] = new Track($controller, $action);
    }

    public function resolve(string $uri, string $method)
    {
        $this->checkMethod($method);
        if (!isset($this->routes[$method][$uri])) {
            throw new \Exception('Страница не найдена');
        }
        $track = $this->getTrack($method, $uri);

        return $track->run();
    }

    private function getTrack($method, $uri): ITrack
    {
        return $this->routes[$method][$uri];
    }

    private function checkMethod($method)
    {
        if (!isset($this->routes[$method])) {
            throw new \Exception('Неверный HTTP-метод');
        }
    }
}