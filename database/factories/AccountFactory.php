<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Account;
use Faker\Generator as Faker;

$factory->define(Account::class, function (Faker $faker) {
    return [
        'account'   =>  $faker->lastName,
        'name'      =>  $faker->name,
        'password' =>   Hash::make('password'), // password
    ];
});
