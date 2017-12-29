<?php

use Illuminate\Database\Seeder;

use App\Developer;
use App\Publisher;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		$developers = Developer::pluck('id')->all();
		$publishers = Publisher::pluck('id')->all();

		foreach (range(1, 20) as $index)
		{

			factory('App\Game')->create([

				'developer_id'=> array_random($developers),
				'publisher_id'=> array_random($publishers),

			]);

		}

		// factory('App\Game')->create();

		// factory('App\Game')->states('image', 'sale')->create([

		// 	'title'=> 'Ninja and Samurai',
		// 	'base_price'=> 7.99,
		// 	'sale_price'=> 4.56,

		// ]);

    }
}
