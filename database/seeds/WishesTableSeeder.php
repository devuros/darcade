<?php

use Illuminate\Database\Seeder;

use App\Game;
use App\User;

class WishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $games = Game::pluck('id')->all();
		$users = User::pluck('id')->all();

		$rows = DB::table('game_user')
        	->select('game_id', 'user_id')
        	->get();

    	$wishes = array();

    	foreach ($rows as $row)
    	{

    		$wishes[$row->user_id.$row->game_id] = 0;

    	}

		foreach (range(1, 30) as $index)
		{

			$game = array_random($games);
			$user = array_random($users);

			if (array_key_exists($user.$game, $wishes))
			{

				continue;

			}

			$wishes[$user.$game] = 0;

			$timestamp = Carbon\Carbon::now();

			DB::table('wishes')->insert([

                'game_id'=> $game,
                'user_id'=> $user,
                'created_at'=> $timestamp,
                'updated_at'=> $timestamp,

            ]);

		}

    }
}
