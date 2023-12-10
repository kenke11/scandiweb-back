<?php

namespace Database\Seeders;

use App\Models\Product;

class ProductSeeder
{
    public function run()
    {
        Product::factory(10);
    }
}