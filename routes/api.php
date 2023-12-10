<?php

use App\Router\ApiRouter;
use App\Controllers\UserController;

ApiRouter::get('/api/users', [UserController::class, 'index']);