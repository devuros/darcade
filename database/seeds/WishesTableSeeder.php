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

        $wishes = $this->getWishesPerUser();

        $games = range(1, $this->getGamesNumber());

		foreach (range(1, $users) as $user)
		{

            // number of wishes to be seeded for the user

            $number_of_wishes = array_random($wishes);

            if ($number_of_wishes == 0)
            {
                continue;
            }

            $user_games = App\Library::where('user_id', $user)
                ->pluck('game_id')
                ->all();

            $user_wishes = array_diff($games, $user_games);

            foreach (range(1, $number_of_wishes) as $wish_index)
            {

                $random_game = array_random($user_wishes);

                factory('App\Wish')->create([

                    'game_id'=> $random_game,
                    'user_id'=> $user

                ]);

                array_pull($user_wishes, $random_game-1);

            }

		}

        // Seed Skeleton RPG

        factory('App\Wish')->create([

            'game_id'=> $this->getGamesNumber()+1,
            'user_id'=> $this->getUsersNumber()+1

        ]);

    }

}
