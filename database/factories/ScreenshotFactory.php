<?php

use Faker\Generator as Faker;

$factory->define(App\Screenshot::class, function (Faker $faker) {
    return [

    	'path'=> 'screen.jpg',
    	'game_id'=> $faker->randomDigitNotNull(),

    ];
});
