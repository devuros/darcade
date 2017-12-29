<?php

use Illuminate\Database\Seeder;

use App\Game;
use App\Genre;

class GameGenreTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$games = Game::pluck('id')->all();
		$genres = Genre::pluck('id')->all();

    	foreach ($games as $game)
    	{

	        DB::table('game_genre')->insert([

				'game_id'=> $game,
				'genre_id'=> array_random($genres),

			]);

		}

    }
}
