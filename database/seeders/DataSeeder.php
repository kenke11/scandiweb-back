<?php

namespace Database\Seeders;

class DataSeeder
{
    public function run()
    {
        $userSeeder = new UserSeeder();
        $userSeeder->run();
    }
}