<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Carbon\Carbon;

use App\User;
use App\Game;

class CartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $users = User::pluck('id')->all();
		$games = Game::pluck('id')->all();

		foreach ($users as $user)
		{
			if($faker->boolean)
			{
				$time = Carbon::now();

				DB::table('carts')->insert([

					'user_id'=> $user,
					'game_id'=> $faker->randomElement($games),
					'created_at'=> $time,
					'updated_at'=> $time,

				]);

			}

		}

    }
}
