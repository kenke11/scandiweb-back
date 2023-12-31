<?php

namespace Database\Seeders;

class DataSeeder
{
    public function run()
    {
        $productSeeder = new ProductSeeder();
        $productSeeder->run();
        $bookSeeder = new BookSeeder();
        $bookSeeder->run();
        $dvdSeeder = new DVDSeeder();
        $dvdSeeder->run();
        $furnitureSeeder = new FurnitureSeeder();
        $furnitureSeeder->run();
    }
}