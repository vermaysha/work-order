<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'wo_number' => 1,
        'title' => $faker->realText('30'),
        'category' => $faker->randomElement(['technical', 'nontechnical']),
        'assign_id' => 1,
        'from_id' => $faker->numberBetween(2, 10),
        'description' => $faker->realText,
        'status' => $faker->randomElement(['open', 'progress', 'finish']),
        'created_at' => now(),
        'updated_at' => now()
    ];
});
