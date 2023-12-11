<?php

namespace Database\Seeders;

use App\Models\DVD;
use App\Models\Product;

class DVDSeeder
{
    public function run()
    {
        $products = Product::all();

        foreach ($products as $product)
        {
            if ($product->getData()['product_type'] === 'dvd')
            {
                DVD::create([
                    'product_id' => $product->getData()['id'],
                    'size' => rand(100, 1000)
                ]);
            }
        }
    }
}