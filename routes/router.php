<?php

function dispatchApi($apiRoutes, $method, $uri) {
    if (isset($apiRoutes[$method][$uri])) {
        $action = explode('@', $apiRoutes[$method][$uri]);
        $controllerName = $action[0];
        $methodName = $action[1];

        $controller = new $controllerName();
        $controller->$methodName();
    } else {
        http_response_code(404);
        echo '404 Not Found';
    }
}

$apiRoutes = include 'api.php';
$request_uri = $_SERVER['REQUEST_URI'];
$request_method = $_SERVER['REQUEST_METHOD'];

dispatchApi($apiRoutes, $request_method, $request_uri);