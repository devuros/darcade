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

        $games = range(1, $this->getGamesNumber());

    	foreach (range(1, $users) as $user)
    	{

            foreach (range(1, array_random($carts)) as $cart) {

                factory('App\Cart')->create([

                    'user_id'=> $user,
                    'game_id'=> array_random($games)

                ]);

            }

		}

        // Seed Skeleton RPG

        factory('App\Cart')->create([

            'user_id'=> $users+1,
            'game_id'=> $this->getGamesNumber()+1

        ]);

    }
}
