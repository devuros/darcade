<?php

use Faker\Generator as Faker;

$factory->define(App\Game::class, function (Faker $faker) {

	$base_price = $faker->randomFloat(2, 0.99, 69.99);
	$sale_price = null;
	$is_on_sale = $faker->boolean(70);

	if($is_on_sale)
	{
		$sale_price = $faker->randomFloat(2, $base_price*0.9, $base_price*0.25);
	}

	$timestamp = $faker->dateTimeBetween('-1 years', 'now');

    return [

    	'title'=> $faker->words(3, true),
    	'image'=> 'storage/app/public/img.jpg',
    	'release_date'=> $faker->dateTimeBetween('-6 years', 'now'),
    	'description'=> $faker->text(155),
    	'about'=> $faker->paragraphs(4, true),
    	'developer_id'=> $faker->randomDigitNotNull(),
    	'publisher_id'=> $faker->randomDigitNotNull(),
    	'base_price'=> $base_price,
    	'sale_price'=> $sale_price,
    	'is_on_sale'=> $is_on_sale,
    	'created_at'=> $timestamp,
    	'updated_at'=> $timestamp,

    ];
});
