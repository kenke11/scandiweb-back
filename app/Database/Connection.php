<?php

namespace App\Database;

use PDO;
use PDOException;

class Connection
{
    protected static $pdo;

    public static function connect(array $config): void
    {
        try {
            self::$pdo = new PDO(
                'mysql:host=' . $config['host'] . ';dbname=' . $config['database'],
                $config['username'],
                $config['password']
            );
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getPdo(): ?PDO
    {
        return self::$pdo;
    }
}