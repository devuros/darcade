<?php

use Faker\Generator as Faker;

$factory->define(App\Wish::class, function (Faker $faker)
{
    return [
        'game_id'=> 1,
        'user_id'=> 1
    ];
});
