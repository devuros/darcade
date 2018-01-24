<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		foreach ($this->getGenresArray() as $genre)
		{

			factory('App\Genre')->create([

				'genre'=> $genre,

			]);

		}


    }
}
