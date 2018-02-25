<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends BaseSeeder
{
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
