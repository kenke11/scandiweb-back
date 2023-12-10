<?php

namespace App\Providers;

use App\Router\ApiRouter;

class ApiRouterProvider {
    public static function provideRoutes() {
        var_dump('aqvar');
        require_once __DIR__ . '/../../routes/api.php';
        return ApiRouter::routes();
    }
}