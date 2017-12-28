<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\Game;
use App\Genre;

class GameGenreTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

    	$games = Game::pluck('id')->all();
		$genres = Genre::pluck('id')->all();

    	foreach ($games as $index)
    	{

	        DB::table('game_genre')->insert([

				'game_id'=> $index,
				'genre_id'=> $faker->randomElement($genres),

			]);
		}

    }
}
