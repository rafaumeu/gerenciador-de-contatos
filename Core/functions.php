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
if (! function_exists('redirect')) {
    function redirect(string $url): void
    {
        session_write_close();
        header("Location: {$url}");
        exit();
    }
}
