<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$tags = [

			'Action',
			'Adventure',
			'Casual',
			'Indie',
			'Massively Multiplayer',
			'Racing',
			'RPG',
			'Simulation',
			'Sports',
			'Strategy'

		];

		$time = Carbon::now();

		foreach ($tags as $tag)
		{

			DB::table('genres')->insert(

				['genre'=> $tag, 'created_at'=> $time, 'updated_at'=> $time]

			);

		}

		// factory('App\Genre', 10)->create();

    }
}
