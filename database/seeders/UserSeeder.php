<?php

namespace Database\Seeders;

use App\Models\User;

class UserSeeder
{
    public function run()
    {
        User::factory(10);
    }
}