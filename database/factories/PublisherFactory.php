<?php

use Faker\Generator as Faker;

$factory->define(App\Publisher::class, function (Faker $faker)
{
    return [
        'publisher'=> $faker->company()
    ];
});
