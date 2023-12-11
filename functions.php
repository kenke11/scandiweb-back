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

    if (is_array($data) && count($data) > 0 && is_object(@$data[0]) && method_exists(@$data[0], 'getData')) {
        $itemData = [];

        foreach ($data as $item) {
            $itemData[] = $item->getData();
        }

        return json_encode($itemData);
    } elseif (is_array($data)) {
        return json_encode($data);
    } else {
        return json_encode($data);
    }
}