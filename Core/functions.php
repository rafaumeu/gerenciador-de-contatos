<?php

declare(strict_types=1);
use Core\Session;

if (! function_exists('flash')) {
    function flash($key, $message = null): mixed
    {
        if ($message) {
            Session::flash($key, $message);

            return null;
        }

        return Session::getFlash($key);
    }
}
if (! function_exists('user')) {
    function user(): mixed
    {
        return Session::get('user');
    }
}
if (! function_exists('check')) {
    function check(): bool
    {
        return Session::has('user');
    }
}
if (! function_exists('env')) {
    function env(string $key, mixed $default = null): mixed
    {
        return $_ENV[$key] ?? $default;
    }
}

if (! function_exists('base_path')) {
    function base_path(string $path = ''): string
    {
        return __DIR__.'/../'.$path;
    }
}

if (! function_exists('config')) {
    function config(string $key, mixed $default = null): mixed
    {
        $keys = explode('.', $key);
        $file = array_shift($keys);

        $path = base_path("config/{$file}.php");

        if (! file_exists($path)) {
            return $default;
        }

        $config = require $path;

        foreach ($keys as $segment) {
            if (! isset($config[$segment])) {
                return $default;
            }
            $config = $config[$segment];
        }

        return $config;
    }
}

if (! function_exists('redirect')) {
    function redirect(string $url): void
    {
        session_write_close();
        header("Location: {$url}");
        exit();
    }
}
