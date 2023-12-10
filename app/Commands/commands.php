<?php

use App\Commands\CreateFactory;
use App\Commands\CreateMigration;
use App\Commands\CreateModel;
use App\Commands\CreateSeeder;
use App\Commands\MigrationRunner;

require_once __DIR__ . '/../../vendor/autoload.php';

if ($argc < 2) {
    echo "Invalid command format. Usage: php commands.php <command>:<name>\n";
    exit(1);
}

$command = $argv[1];
$name = $argv[2];

switch ($command) {
    case 'make:model':
        CreateModel::execute($name);
        break;
    case 'make:migration':
        CreateMigration::execute($name);
        break;
    case 'make:factory':
        CreateFactory::execute($name);
        break;
    case 'make:seeder':
        CreateSeeder::execute($name);
        break;
    case 'migration:run':
        MigrationRunner::execute();
        break;
    default:
        echo "Invalid command. Available commands: make:model, make:migration, make:factory, make:seeder migration:run\n";
        break;
}