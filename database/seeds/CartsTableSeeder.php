<?php

use Illuminate\Database\Seeder;

class CartsTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = $this->getUsersNumber();

        $carts = $this->getGamesInCartPerUser();

        $games = $this->getGamesNumber();

    	foreach (range(1, $users) as $user)
    	{

            $games_array = range(1, $games);

            foreach (range(1, array_random($carts)) as $cart)
            {

                $game = array_random($games_array);

                factory('App\Cart')->create([

                    'user_id'=> $user,
                    'game_id'=> $game

                ]);

                array_pull($games_array, $game-1);

            }

		}

        // Add Skeleton RPG to Milos Radosavljevic's cart

        factory('App\Cart')->create([

            'user_id'=> $users+1,
            'game_id'=> $this->getGamesNumber()+1

        ]);

    }
}
