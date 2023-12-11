<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Product;

class BookSeeder
{
    public function run()
    {
        $products = Product::all();

        foreach ($products as $product)
        {
            if ($product->getData()['product_type'] === 'book')
            {
                Book::create([
                    'product_id' => $product->getData()['id'],
                    'weight' => rand(10, 100)
                ]);
            }
        }
    }
}