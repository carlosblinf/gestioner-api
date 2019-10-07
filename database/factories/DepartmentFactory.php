<?php

use App\Department;
use Faker\Generator as Faker;

$factory->define(Department::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence(3),
        'chief' => $faker->numberBetween($min = 1, $max = 100),
    ];
});
