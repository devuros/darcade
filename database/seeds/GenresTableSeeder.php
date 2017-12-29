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

		foreach ($tags as $tag)
		{

			factory('App\Genre')->create([

				'genre'=> $tag,

			]);

		}


    }
}
