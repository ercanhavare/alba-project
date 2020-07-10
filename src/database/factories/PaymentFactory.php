<?php

/** @var Factory $factory */

use App\Models\Payment;
use App\Models\Product;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        "user_id" => User::all()->random()->id,
        "product_id" => Product::all()->random()->id,
        "total_price" => $faker->numberBetween(100, 200),
    ];
});
