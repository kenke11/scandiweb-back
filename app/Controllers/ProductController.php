<?php

namespace App\Controllers;


use App\Models\Product;

class ProductController
{
    public function index()
    {
        $products = Product::all();

        return response($products);
    }
}