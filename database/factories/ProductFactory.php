<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'      =>$faker->word,
        'title'      =>$faker->word,
        'menu_id'      =>$faker->numberBetween($min=1,$max=5),
        'sub_id'      =>$faker->numberBetween($min=1,$max=5),
        'price'      =>$faker->numberBetween($min=100,$max=3000),
        'stock'      =>$faker->numberBetween($min=100,$max=300),
        'img'        =>'upload_img/product_'.rand(1,12).".jpg", 
    ];
});
