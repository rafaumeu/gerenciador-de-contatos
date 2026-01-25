<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

// Load Environment Variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->safeLoad();

require_once __DIR__.'/../Core/functions.php';
require __DIR__.'/../config/route.php';
