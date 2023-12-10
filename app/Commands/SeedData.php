<?php

namespace App\Commands;

use App\Database\Connection;
use Database\Seeders\UserSeeder;
use Dotenv\Dotenv;

class SeedData
{
    public static function execute()
    {
        $dotenv = Dotenv::createImmutable(__DIR__, '../../.env');
        $dotenv->load();
        $databaseConfig = require_once __DIR__ . '/../../config/database.php';
        Connection::connect($databaseConfig['mysql']);

        $dataSeeder = new UserSeeder();
        $dataSeeder->run();

        echo "all seeders successfully seeded.\n";
    }
}