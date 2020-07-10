<?php

/** @var Factory $factory */

use App\Models\Image;
use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Image::class, function (Faker $faker) {
    return [
        "name" => $faker->safeColorName,
        "path" => "https://landerapp.com/blog/wp-content/uploads/2018/05/MAG-FR-Oestreicher-Singer-Product-Recommendation-Viral-Marketing-Social-Media-Network-Ecommerce-1200-1200x627.jpg",
        "product_id" => Product::all()->random()->id,
    ];
});
