<?php

declare(strict_types=1);

namespace Core;

class Route
{
    protected array $routes = [];

    public function get(string $uri, string $controller): void
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post(string $uri, string $controller): void
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function dispatch(string $uri, string $method): void
    {
        if (array_key_exists($uri, $this->routes[$method])) {
            $controller = $this->routes[$method][$uri];
            echo 'Achei a rota! Controller: '.$controller;
        } else {
            http_response_code(404);
            echo 'Rota não encontrada!';
        }
    }
}
