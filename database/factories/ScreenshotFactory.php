<?php

use Faker\Generator as Faker;

$factory->define(App\Screenshot::class, function (Faker $faker) {
    return [

        'path'=> 'path.ext',
        'game_id'=> function () {

            return App\Game::inRandomOrder()->first();

        },

    ];
});
