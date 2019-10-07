<?php

use App\Persona;
use Faker\Generator as Faker;

$factory->define(Persona::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName, 
        'lastname' => $faker->lastName,
        'ci' => $faker->randomElement(['92091141962','03091141962','97101241962']),
        'address' => $faker->address,
        'gender' => $faker->randomElement(['masculino','femenino']),
        'phone' => $faker->phoneNumber,
        'celphone' => $faker->e164PhoneNumber,
        'email' => $faker->email,
        'civil_status' => $faker->randomElement(['soltero(a)', 'casado(a)', 'comprometido(a)']),
        'date_birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'ocupations' => $faker->company,
        'professions' => $faker->jobTitle,
        'desease' => $faker->word,
        'celula' => $faker->word,
        'member' => $faker->randomElement([Persona::PERSONA_MEMBER, Persona::PERSONA_NO_MEMBER]),
        'department_id' => $faker->numberBetween($min = 1, $max = 6),
    ];
});
