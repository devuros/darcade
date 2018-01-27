<?php

use Faker\Generator as Faker;

$factory->define(App\Cart::class, function (Faker $faker) {

    return [

        'user_id'=> 1,
        'game_id'=> 1

    ];

});
