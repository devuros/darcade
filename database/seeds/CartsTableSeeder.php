<?php

use Illuminate\Database\Seeder;

class CartsTableSeeder extends BaseSeeder
{
    public function run()
    {
        $users = $this->getUsersNumber();
        $carts = $this->getGamesInCartPerUser();
        $games = $this->getGamesNumber();

    	foreach (range(1, $users) as $user)
    	{
            // number of games to be seeded in the user's cart
            $number_of_carts = array_random($carts);

            if ($number_of_carts == 0)
            {
                continue;
            }

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
