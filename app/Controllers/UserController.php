<?php

namespace App\Controllers;

class UserController
{
    public function index()
    {
        $databaseHost = $_ENV['DB_HOST'];

        return $databaseHost;
    }
}