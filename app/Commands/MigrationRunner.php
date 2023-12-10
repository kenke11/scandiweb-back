<?php

namespace App\Commands;

class MigrationRunner
{
    public static function execute()
    {
        $migrationFiles = glob("database/migrations/*.php");

        foreach ($migrationFiles as $file) {
            require_once $file;
            $migration = require $file;
            $migration->up();
            echo "Migration executed: $file\n";
        }

        echo "All migrations executed successfully.\n";
    }
}