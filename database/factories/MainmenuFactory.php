<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Mainmenu;
use Faker\Generator as Faker;

$factory->define(Mainmenu::class, function (Faker $faker) {
    return [
        'name'      =>$faker->word,
    ];
});
