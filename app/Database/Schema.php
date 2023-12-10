<?php

namespace App\Database;
use Dotenv\Dotenv;

class Schema {
    private static function databaseConnection(): ?\PDO
    {
        $dotenv = Dotenv::createImmutable(__DIR__, '../../.env');
        $dotenv->load();
        $databaseConfig = require_once __DIR__ . '/../../config/database.php';
        Connection::connect($databaseConfig['mysql']);
        return Connection::getPdo();
    }

    public static function create($tableName, $callback): void
    {
        echo "Creating table: $tableName\n";
        $columns = new Columns();
        call_user_func($callback, $columns);
        // Implement SQL execution logic to create the table based on $tableName and $columns
        $sql = "CREATE TABLE IF NOT EXISTS `$tableName` (" . implode(', ', $columns->getColumns()) . ")";
        // Execute the SQL query
        self::databaseConnection()->query($sql);
    }

    public static function dropIfExists($tableName): void
    {
        echo "Dropping table if exists: $tableName\n";
        // Get the PDO connection
        $pdo = Connection::getPdo();
        // Implement SQL execution logic to drop the table if it exists
        $sql = "DROP TABLE IF EXISTS `$tableName`";
        // Execute the SQL query
        self::databaseConnection()->query($sql);
    }
}
class Columns {
    private $columns = [];

    public function increments($columnName): void
    {
        $this->columns[] = "$columnName INT AUTO_INCREMENT PRIMARY KEY";
    }

    public function string($columnName, $length = 255): void
    {
        $this->columns[] = "$columnName VARCHAR($length)";
    }

    public function timestamp($columnName): void
    {
        $this->columns[] = "$columnName TIMESTAMP";
    }

    public function boolean($columnName): void
    {
        $this->columns[] = "$columnName BOOLEAN";
    }

    public function getColumns(): array
    {
        return $this->columns;
    }
}