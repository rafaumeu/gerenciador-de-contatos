<?php

declare(strict_types=1);

namespace Core;

use PDO;
use PDOException;

class Database
{
    private static ?Database $instance = null;

    private PDO $connection;

    private function __construct()
    {
        try {
            $dbPath = __DIR__.'/../../database/database.sqlite';
            if (! file_exists($dbPath)) {
                touch($dbPath);
            }
            $absolutePath = realpath($dbPath);
            $this->connection = new PDO("sqlite:$absolutePath");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            exit('Database Connection Failed: '.$e->getMessage());
        }
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
