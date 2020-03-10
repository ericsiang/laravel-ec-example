<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductMultipleImg;
use Faker\Generator as Faker;

$factory->define(ProductMultipleImg::class, function (Faker $faker) {
    return [
        'p_id'  =>$faker->numberBetween($min=1,$max=10),
        'img'   =>'upload_img/product_back_'.rand(1,12).".jpg",
        'type'  =>1 
    ];
});
