<?php

use App\Activity;
use Faker\Generator as Faker;

$factory->define(Activity::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence(6),
        'dateStart' => $faker->dateTime($max = 'now', $timezone = null),
        'dateEnd' => $faker->dateTimeThisMonth($max = 'now', $timezone = null),
        'user_id' => $faker->numberBetween($min = 2, $max = 6),
    ];
});
