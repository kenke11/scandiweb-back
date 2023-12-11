<?php

namespace App\Router;

class ApiRouter {
    private static $routes = [];

    public static function get($uri, $controllerAction) {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Headers: Content-Type");
        self::addRoute('GET', $uri, $controllerAction);
    }

    public static function post($uri, $controllerAction) {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        self::addRoute('POST', $uri, $controllerAction);
    }

    public static function put($uri, $controllerAction) {
        self::addRoute('PUT', $uri, $controllerAction);
    }

    public static function delete($uri, $controllerAction) {
        self::addRoute('DELETE', $uri, $controllerAction);
    }

    private static function addRoute($method, $uri, $controllerAction) {
        self::$routes[$method][$uri] = $controllerAction;
    }

    public static function handle($request_uri, $request_method) {
        if (isset(self::$routes[$request_method][$request_uri])) {
            $action = self::$routes[$request_method][$request_uri];

            if (is_array($action)) {
                $controller = new $action[0]();
                $method = $action[1];

                return call_user_func_array([$controller, $method], []);
            }
        }

        self::handleNotFound(); // Handle 404 Not Found
    }

    private static function handleNotFound() {
        http_response_code(404);
        echo '404 Not Found';
        exit;
    }
}