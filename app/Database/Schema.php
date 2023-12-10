<?php

namespace App\Database;

use Dotenv\Dotenv;

class Schema {
    private static function databaseConnection(): ?\PDO
    {
        if (!Connection::getPdo()){
            $dotenv = Dotenv::createImmutable(__DIR__, '../../.env');
            $dotenv->load();

            $databaseConfig = require_once __DIR__ . '/../../config/database.php';
            Connection::connect($databaseConfig['mysql']);
        }
        return Connection::getPdo();
    }

    public static function create($tableName, $callback): void
    {
        echo "Creating table: $tableName\n";
        $columns = new Columns();
        call_user_func($callback, $columns);
        $columnDefinitions = $columns->getColumns();
        $columnStrings = implode(', ', $columnDefinitions);

        $sql = "CREATE TABLE IF NOT EXISTS `$tableName` ($columnStrings)";
        self::databaseConnection()->query($sql);
    }

    public static function dropIfExists($tableName): void
    {
        echo "Dropping table if exists: $tableName\n";

        $sql = "DROP TABLE IF EXISTS `$tableName`";

        self::databaseConnection()->query($sql);
    }
}

class Columns {
    private $columns = [];

    public function increments($columnName): self
    {
        $this->columns[] = "$columnName INT AUTO_INCREMENT PRIMARY KEY";
        return $this;
    }

    public function string($columnName, $length = 255): self
    {
        $this->columns[] = "$columnName VARCHAR($length)";
        return $this;
    }

    public function timestamp($columnName): self
    {
        $this->columns[] = "$columnName TIMESTAMP";
        return $this;
    }

    public function boolean($columnName): self
    {
        $this->columns[] = "$columnName BOOLEAN";
        return $this;
    }

    public function number($columnName): self
    {
        $this->columns[] = "$columnName INT";
        return $this;
    }

    public function enum($columnName, array $allowedValues): self
    {
        $allowedValues = array_map(function ($value) {
            return "'$value'";
        }, $allowedValues);
        $enumValues = implode(',', $allowedValues);
        $this->columns[] = "$columnName ENUM($enumValues)";
        return $this;
    }

    public function unique(): self
    {
        $this->columns[count($this->columns) - 1] .= " UNIQUE";
        return $this;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }
}