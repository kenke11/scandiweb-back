<?php

namespace Database\Factories;

use App\Database\Factory\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $enumValues = ['dvd', 'book', 'furniture'];

        return [
            'sku' => $this->fakeSKU(),
            'name' => $this->fakeProductName(),
            'price' => $this->fakeNumber(),
            'product_type' => $this->fakeEnumVariable($enumValues)
        ];
    }
}