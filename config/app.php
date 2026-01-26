<?php

return [
    'app' => [
        'name' => env('APP_NAME', 'Gerenciador de Contatos'),
        'env' => env('APP_ENV', 'production'),
        'key' => env('APP_KEY'),
        'debug' => env('APP_DEBUG', false),
        'url' => env('APP_URL', 'http://localhost'),
    ],

    'database' => [
        'path' => str_starts_with(env('DB_PATH', ''), '/')
            ? env('DB_PATH')
            : base_path(env('DB_PATH', 'database/database.sqlite')),
    ],

    'security' => [
        'encryption_key' => env('ENCRYPTION_KEY'),
    ],
];
