<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    public function index()
    {
        $user = User::create([
            'name' => 'rame',
            'email' => 'ex@ex.com'
        ]);

        var_dump($user);
        die();
    }
}