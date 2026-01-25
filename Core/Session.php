<?php

declare(strict_types=1);

namespace Core;

class Session
{
    public static function init(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            ini_set('session.cookie_httponly', '1');
            ini_set('session.use_strict_mode', '1');
            session_start();
        }
    }

    public static function put(string $key, mixed $value): void
    {
        self::init();
        $_SESSION[$key] = $value;
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        self::init();

        return $_SESSION[$key] ?? $default;
    }

    public static function forget(string $key): void
    {
        self::init();
        unset($_SESSION[$key]);
    }

    public static function destroy(): void
    {
        self::init();
        $_SESSION = [];
        session_destroy();
    }

    public static function has(string $key): bool
    {
        self::init();

        return isset($_SESSION[$key]);
    }

    public static function regenerate(): void
    {
        self::init();
        session_regenerate_id(true);
    }

    public static function flash(string $key, mixed $message): void
    {
        self::init();
        $_SESSION['flash'][$key] = $message;
    }

    public static function getFlash(string $key): mixed
    {
        self::init();
        if (isset($_SESSION['flash'][$key])) {
            $message = $_SESSION['flash'][$key] ?? null;
            unset($_SESSION['flash'][$key]);

            return $message;
        }

        return null;
    }

    public static function remove(string $key): void
    {
        self::forget($key);
    }
}
