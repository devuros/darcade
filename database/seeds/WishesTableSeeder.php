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

		$users = $this->getUsersNumber();

        $wishes = $this->getWishesPerGame();

        $games = range(1, $this->getGamesNumber());

		foreach (range(1, $users) as $user)
		{

            // number of wishes to be seeded for the user

            $number_of_wishes = array_random($wishes);

            if ($number_of_wishes == 0)
            {
                continue;
            }

            $user_games = App\Library::where('user_id', $user)->pluck('game_id')->all();

            //

            foreach (range(1, $number_of_wishes) as $wish_index)
            {

                factory('App\Wish')->create([

                    'game_id'=> ,
                    'user_id'=> $user

                ]);

                //

            }

		}

    }

}
