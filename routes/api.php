<?php

use App\Controllers\ProductController;
use App\Router\ApiRouter;

ApiRouter::get('/api/products', [ProductController::class, 'index']);
