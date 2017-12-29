<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

use App\User;
use App\Game;

class WishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
    	$games = Game::pluck('id')->all();
    	$users = User::pluck('id')->all();

		foreach ($users as $user)
		{
			if($faker->boolean(80))
	    	{
	    		$time = $faker->dateTimeBetween('-1 years', 'now');

	    		DB::table('wishes')->insert([

					'game_id'=> $faker->randomElement($games),
					'user_id'=> $user,
					'created_at'=> $time,
					'updated_at'=> $time,

				]);

	    	}

		}

    }
}
