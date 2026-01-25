<?php

declare(strict_types=1);

namespace Core;

use App\Middleware\Auth;

class Route
{
    protected array $routes = [];

    protected $lastRoute = '';

    protected $lastMethod = '';

    public function get(string $uri, string $controller): self
    {
        $this->register('GET', $uri, $controller);

        return $this;
    }

    public function post(string $uri, string $controller): self
    {
        $this->register('POST', $uri, $controller);

        return $this;
    }

    protected function register(string $method, string $uri, string $controller): void
    {
        $this->routes[$method][$uri] = [
            'action' => $controller,
            'middleware' => [],
        ];
        $this->lastRoute = $uri;
        $this->lastMethod = $method;
    }

    public function middleware(string $key): self
    {
        $this->routes[$this->lastMethod][$this->lastRoute]['middleware'][] = $key;

        return $this;
    }

    public function dispatch(string $uri, string $method): void
    {
        if (! isset($this->routes[$method][$uri])) {
            http_response_code(404);
            echo "404 - Metodo {$method} nao permitido ou sem rotas definidas";
            exit;
        }
        $route = $this->routes[$method][$uri];
        foreach ($route['middleware'] as $middleware) {
            if ($middleware === 'auth') {
                (new Auth)->handle();
            }
        }
        $action = $route['action'];
        [$controllerClass, $methodName] = explode('@', $action);
        $controller = new $controllerClass;
        $controller->$methodName();
    }
}
