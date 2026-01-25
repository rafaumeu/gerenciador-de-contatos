<?php

declare(strict_types=1);

namespace Core;

class Request
{
    public function uri(): string
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        return '/'.trim($uri, '/');
    }

    public function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function all(): array
    {
        return $_REQUEST;
    }
}
