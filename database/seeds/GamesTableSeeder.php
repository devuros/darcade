<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

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

				'image'=> function () {

					$path = Storage::disk('public')->putFile('games', $this->getDefaultGameImage());

					return $path;

				},
				'developer_id'=> array_random($developers),
				'publisher_id'=> array_random($publishers)

			]);

		}

		factory('App\Game')->states('sale')->create([

			'title'=> 'Skeleton RPG',
			'image'=> function () {

				$path = Storage::disk('public')->putFile('games', new File('storage/app/jolly.png'));

				return $path;

			},
			'release_date'=> '2018-01-25 20:00:00',
			'description'=> 'Skeleton RPG is a true masterpiece, written in c# and made in Unity.
			It\'s a game where talent meets enthusiasm. Simply the best.',
			'developer_id'=> $this->getDevelopersNumber()+1,
			'publisher_id'=> $this->getPublishersNumber()+1,
			'base_price'=> 14.99,
			'sale_price'=> 10.49

		]);

    }
}
