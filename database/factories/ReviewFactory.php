<?php

use Faker\Generator as Faker;

$factory->define(App\Review::class, function (Faker $faker) {

	return [

        'game_id'=> 1,
        'user_id'=> 1,
        'recommended'=> $faker->boolean(),
        'body'=> $faker->paragraph(2, true)

    ];

});
