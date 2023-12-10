<?php

namespace App\Commands;

use App\Database\Connection;
use Dotenv\Dotenv;
use PDO;

class DropBase
{
    public static function execute()
    {
        $dotenv = Dotenv::createImmutable(__DIR__, '../../.env');
        $dotenv->load();
        $databaseConfig = require_once __DIR__ . '/../../config/database.php';

        Connection::connect($databaseConfig['mysql']);
        $pdo = Connection::getPdo();

        $dbName = $databaseConfig['mysql']['database'];

        $tablesQuery = $pdo->query("SHOW TABLES");
        $tables = $tablesQuery->fetchAll(PDO::FETCH_COLUMN);

        foreach ($tables as $table) {
            $dropQuery = "DROP TABLE IF EXISTS `$table`";
            $pdo->exec($dropQuery);
            echo "Dropped table: $table\n";
        }

        echo "All tables dropped successfully.\n";
    }
}