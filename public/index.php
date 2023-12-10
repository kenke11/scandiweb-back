<?php

namespace App\Controllers\UserController;

use App\Database\Connection;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';
require_once '../functions.php';

$dotenv = Dotenv::createImmutable(__DIR__, '../.env');
$dotenv->load();

if (
    isset($_ENV['DB_HOST'], $_ENV['DB_DATABASE'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'])
) {
    $databaseConfig = require_once __DIR__ . '/../config/database.php';
    Connection::connect($databaseConfig['mysql']);
}

$request_uri = $_SERVER['REQUEST_URI'];
$request_method = $_SERVER['REQUEST_METHOD'];

if (strpos($request_uri, '/api') === 0) {
    require_once __DIR__ . '/../app/Router/ApiRouter.php';
    require_once __DIR__ . '/../routes/api.php';

    $response = \App\Router\ApiRouter::handle($request_uri, $request_method);

    responseNull($response);
} else {
    notFound();
}

function responseNull($response): void
{
    if ($response !== null) {
        echo $response;
        exit;
    } else {
        notFound();
    }
}

function notFound(): void
{
    http_response_code(404);
    echo '404 Not Found';
}