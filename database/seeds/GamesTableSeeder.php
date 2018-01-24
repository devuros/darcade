<?php

use Illuminate\Database\Seeder;

use App\Developer;
use App\Publisher;

class GamesTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		$developers = range(1, $this->getDevelopersNumber());
		$publishers = range(1, $this->getPublishersNumber());

		foreach (range(1, $this->getGamesNumber()) as $index)
		{

			factory('App\Game')->create([

				'developer_id'=> array_random($developers),
				'publisher_id'=> array_random($publishers),
				'image'=> function () {

					//

				}

			]);

		}

		factory('App\Game')->create([

			'title'=> 'Skeleton RPG',
			'image'=> 'example.jpg',
			'description'=> 'Skeleton RPG is a true masterpiece, written in c# and made in Unity.
			It\'s a game where talent meets enthusiasm. Simply the best.',
			'developer_id'=> $this->getDevelopersNumber()+1,
			'publisher_id'=> $this->getPublishersNumber()+1,
			'is_on_sale'=> true

		]);

		// factory('App\Game')->states('image', 'sale')->create([

		// 	'title'=> 'Ninja and Samurai',
		// 	'base_price'=> 7.99,
		// 	'sale_price'=> 4.56,

		// ]);

    }
}
