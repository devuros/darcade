<?php

use Illuminate\Database\Seeder;

use App\Game;
use App\User;

class CartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$games = Game::pluck('id')->all();
		$users = User::pluck('id')->all();

    	foreach (range(1, 10) as $index)
    	{
    		$time = Carbon\Carbon::now();

            DB::table('carts')->insert([

                'user_id'=> array_random($users),
                'game_id'=> array_random($games),
                'created_at'=> $time,
                'updated_at'=> $time,

            ]);

		}

    }
}
