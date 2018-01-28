<?php

use Illuminate\Database\Seeder;

use App\GameGenre;

class GameGenreTableSeeder extends BaseSeeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$games = $this->getGamesNumber();

        $genres = range(1, count($this->getGenresArray()));

    	foreach (range(1, $games) as $game)
    	{

	        $game_genre = new GameGenre;

            $game_genre->game_id = $game;
            $game_genre->genre_id = array_random($genres);

            $game_genre->save();

		}

        // Attach genre for Skeleton RPG

        $skeleton_genre = new GameGenre;

        $skeleton_genre->game_id = $games+1;
        $skeleton_genre->genre_id = array_random($genres);

        $skeleton_genre->save();

    }
}
