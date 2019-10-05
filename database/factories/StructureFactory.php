<?php

use App\Structure;
use Faker\Generator as Faker;

$factory->define(Structure::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->text,
        'chief' => $faker->name,
    ];
});
