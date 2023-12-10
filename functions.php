<?php

use JetBrains\PhpStorm\NoReturn;

#[NoReturn]
function dd($value): void
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}

function response($data, $statusCode = 200): false|string
{
    http_response_code($statusCode);
    header("Access-Control-Allow-Origin: http://localhost:8080");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");
    $itemData = [];

    foreach ($data as $item) {
        $itemData[] = $item->getData();
    }

    return json_encode($itemData);
}