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

    public function fakeSKU(): string
    {
        return strtoupper($this->faker->bothify('???')) . '-' . time() . '-' . strtoupper($this->faker->bothify('#?#'));
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

    public function fakeEnumVariable($enumValues): string
    {
        $randomIndex = array_rand($enumValues);
        return $enumValues[$randomIndex];
    }

    public function fakeNumber($digits = 4): int
    {
        return $this->faker->numberBetween(10 ** ($digits - 1), (10 ** $digits) - 1);
    }
}