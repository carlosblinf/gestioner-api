<?php

use App\Structure;
use Faker\Generator as Faker;

$factory->define(Structure::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence(3),
        'chief' => $faker->numberBetween($min = 1, $max = 100),
    ];
});
