<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Submenu;
use Faker\Generator as Faker;

$factory->define(Submenu::class, function (Faker $faker) {
    return [
        'menu_id'   =>$faker->numberBetween($min=1,$max=5),
        'name'      =>$faker->name,
    ];
});
