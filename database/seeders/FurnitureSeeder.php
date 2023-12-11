<?php

namespace Database\Seeders;

use App\Models\Furniture;
use App\Models\Product;

class FurnitureSeeder
{
    public function run()
    {
        $products = Product::all();

        foreach ($products as $product)
        {
            if ($product->getData()['product_type'] === 'furniture')
            {
                Furniture::create([
                    'product_id' => $product->getData()['id'],
                    'width' => rand(10, 100),
                    'height' => rand(10, 100),
                    'length' => rand(10, 100)
                ]);
            }
        }
    }
}