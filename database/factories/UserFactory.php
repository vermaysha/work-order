<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'fullname'   => $faker->name,
        'username'   => $faker->unique()->userName,
        'email'      => $faker->unique()->safeEmail,
        'password'   => Hash::make('12345678'),
        'role'       => $faker->randomElement(['user', 'developer']),
        'created_at' => now(),
        'updated_at' => now()
    ];
});
