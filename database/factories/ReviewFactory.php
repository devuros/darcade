<?php

use Faker\Generator as Faker;

$factory->define(App\Review::class, function (Faker $faker) {
    return [

        'game_id'=> $faker->randomDigitNotNull(),
        'user_id'=> $faker->randomDigitNotNull(),
        'recommended'=> $faker->boolean,
        'body'=> $faker->paragraphs(1, true),
        'votes'=> 0,

    ];
});
