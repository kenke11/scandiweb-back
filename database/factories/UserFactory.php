<?php

namespace Database\Factories;

use App\Database\Factory\Factory;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->fakeName(),
            'email' => $this->fakeEmail()
        ];
    }
}