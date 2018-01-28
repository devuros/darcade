<?php

use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = $this->getUsersNumber();

        $reviews = $this->getReviewsPerUser();

    	foreach (range(1, $users) as $user)
    	{

    		// number of reviews to be seeded for the user

            $number_of_reviews = array_random($reviews);

            if ($number_of_reviews == 0)
            {
                continue;
            }

            $user_games = App\Library::where('user_id', $user)
                ->pluck('game_id')
                ->all();

            if (count($user_games) == 0)
            {
                continue;
            }

            if ($number_of_reviews > count($user_games))
            {

                $number_of_reviews = count($user_games);

            }

            foreach (range(1, $number_of_reviews) as $review_index)
            {

                $random_game = array_random($user_games);

                factory('App\Review')->create([

                    'game_id'=> $random_game,
                    'user_id'=> $user

                ]);

                array_pull($user_games, $random_game-1);

            }

    	}

    }
}
