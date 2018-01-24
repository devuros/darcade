<?php

use Faker\Generator as Faker;

$factory->define(App\Game::class, function (Faker $faker) {

    $base_price = $faker->randomFloat(2, 0.99, 69.99);
    $sale_price = $faker->randomFloat(2, $base_price*0.9, $base_price*0.25);

	return [

    	'title'=> $faker->words(

            $faker->numberBetween(2, 3),
            true

        ),

    	'image'=> 'image.jpg',

    	'release_date'=> $faker->dateTimeBetween('-6 years', 'now'),

    	'description'=> $faker->text(155),

    	'about'=> $faker->paragraphs(4, true),

    	'developer_id'=> function () {

            return factory('App\Developer')->create()->id;

        },

    	'publisher_id'=> function () {

            return factory('App\Publisher')->create()->id;

        },

    	'base_price'=> $base_price,

    	'sale_price'=> $sale_price,

    	'is_on_sale'=> $faker->boolean(50),

    ];

});

// State se koristi da bi se dodelila neka podrazumevana vrednost

$factory->state(App\Game::class, 'sale', [

    'is_on_sale'=> true

]);

$factory->state(App\Game::class, 'image', [

    'image'=> 'example.png'

]);
