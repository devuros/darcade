<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\Developer;
use App\Publisher;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

		$developers = Developer::pluck('id')->all();
		$publishers = Publisher::pluck('id')->all();

		foreach (range(1, 19) as $index)
		{
			$base_price = $faker->randomFloat(2, 0.99, 69.99);
			$sale_price = $faker->randomFloat(2, $base_price*0.9, $base_price*0.25);

			factory('App\Game')->create([

				'developer_id'=> $faker->randomElement($developers),
				'publisher_id'=> $faker->randomElement($publishers),
				'base_price'=> $base_price,
				'sale_price'=> $sale_price,

			]);

		}

        factory('App\Game')->states('image', 'sale')->create([

        	'title'=> 'Ninja and Samurai',
        	'base_price'=> 7.99,
			'sale_price'=> 4.56,

        ]);

    }
}
