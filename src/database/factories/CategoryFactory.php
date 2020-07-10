<?php

/** @var Factory $factory */

use App\Models\Category;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Category::class, function (Faker $faker) {
    return [
        "name" => $faker->monthName,
        "user_id" => User::all()->random()->id
    ];
});
