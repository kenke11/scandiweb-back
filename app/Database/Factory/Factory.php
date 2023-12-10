<?php

namespace App\Database\Factory;

use Faker\Factory as Faker;

abstract class Factory
{
    protected \Faker\Generator $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
    }

    public function fakeName(): string
    {
        return $this->faker->name;
    }

    public function fakeEmail(): string
    {
        return $this->faker->unique()->safeEmail;
    }

    public function fakeProductName(): string
    {
        return $this->faker->word;
    }

    public function fakeBoolean(): bool
    {
        return $this->faker->boolean;
    }
}