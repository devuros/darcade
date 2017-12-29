<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\Game;
use App\User;

class CartsTableSeeder extends Seeder
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
    		if($faker->boolean)
    		{
    			$time = Carbon\Carbon::now();

    			DB::table('carts')->insert([

					'user_id'=> $user,
					'game_id'=> array_random($games),
					'created_at'=> $time,
					'updated_at'=> $time,

				]);

    		}

		}

    }
}
