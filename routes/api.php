<?php

use App\Controllers\ProductController;
use App\Router\ApiRouter;

ApiRouter::get('/api/products', [ProductController::class, 'index']);
ApiRouter::post('/api/products/destroy', [ProductController::class, 'delete']);