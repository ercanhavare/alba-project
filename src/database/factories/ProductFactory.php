<?php

/** @var Factory $factory */

use App\Models\Category;
use App\Models\Product;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Product::class, function (Faker $faker) {
    return [
        "name" => $faker->colorName,
        "quantity" => $faker->numberBetween(10, 50),
        "price" => $faker->numberBetween(100, 500),
        "desc" => $faker->text,
        "category_id" => Category::all()->random()->id,
        "user_id" => User::all()->random()->id
    ];
});
