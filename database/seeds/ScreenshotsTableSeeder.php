<?php

use Illuminate\Database\Seeder;
use App\Game;

class ScreenshotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $games = Game::pluck('id')->all();


        foreach ($games as $game)
        {

            factory('App\Screenshot', rand(2, 4))->create([

                'game_id'=> $game,

            ]);

        }

        // factory('App\Screenshot', 2)->create();

    }
}
