<?php

use Illuminate\Database\Seeder;

use App\Game;
use App\User;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Seed tables: orders, purchases, game_user

        $games = Game::all('id', 'base_price', 'sale_price', 'is_on_sale')->toArray();
		$users = User::pluck('id')->all();

        foreach ($users as $user)
        {

        	$random_games = array_random($games, rand(1, 3));

        	$time = Carbon\Carbon::now();

        	$order_id = DB::table('orders')->insertGetId([

                'user_id'=> $user,
                'total'=> 0,
                'created_at'=> $time,
                'updated_at'=> $time,

            ]);

            $total = 0;

        	foreach ($random_games as $random_game)
        	{

        		$actual_price = 0;

        		if ($random_game['is_on_sale'])
        		{

        			$total += $random_game['sale_price'];
        			$actual_price = $random_game['sale_price'];

        		}
        		else
        		{

        			$total += $random_game['base_price'];
        			$actual_price = $random_game['base_price'];

        		}

	            DB::table('purchases')->insert([

	                'game_id'=> $random_game['id'],
	                'order_id'=> $order_id,
	                'actual_price'=> $actual_price,

	            ]);

	            DB::table('game_user')->insert([

	                'game_id'=> $random_game['id'],
	                'user_id'=> $user,
	                'created_at'=> $time,
	                'updated_at'=> $time,

	            ]);

            }

            DB::table('orders')->where('id', $order_id)->update(['total'=> $total]);

        }

    }
}
