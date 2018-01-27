<?php

use Illuminate\Database\Seeder;

class WishesTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		//

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
