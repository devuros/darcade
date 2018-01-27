<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends BaseSeeder
{
    /**
     * Seed tables: orders, purchases, game_user
     */
    public function run()
    {

        $users = $this->getUsersNumber();

        $games = $this->getGamesNumber();

        $orders = $this->getOrdersPerUser();

        $purchases = $this->getPurchasesPerOrder();

        foreach (range(1, $users) as $user)
        {

            // number of orders that will be seeded for the user

            $user_orders = array_random($orders);

            if ($user_orders != 0)
            {

                // number of purchases that will be seeded for the order

                $order_purchases = array_random($purchases);

                foreach (range(1, $order_purchases) as $index)
                {

                    //

                }

            }

        }

    }

    // $random_games = array_random($games, rand(1, 3));

    // $time = Carbon\Carbon::now();

    // $order_id = DB::table('orders')->insertGetId([

    //     'user_id'=> $user,
    //     'total'=> 0,
    //     'created_at'=> $time,
    //     'updated_at'=> $time,

    // ]);

    // $total = 0;

    // foreach ($random_games as $random_game)
    // {

    //     $actual_price = 0;

    //     if ($random_game['is_on_sale'])
    //     {

    //         $total += $random_game['sale_price'];
    //         $actual_price = $random_game['sale_price'];

    //     }
    //     else
    //     {

    //         $total += $random_game['base_price'];
    //         $actual_price = $random_game['base_price'];

    //     }

    //     DB::table('purchases')->insert([

    //         'game_id'=> $random_game['id'],
    //         'order_id'=> $order_id,
    //         'actual_price'=> $actual_price,

    //     ]);

    //     DB::table('game_user')->insert([

    //         'game_id'=> $random_game['id'],
    //         'user_id'=> $user,
    //         'created_at'=> $time,
    //         'updated_at'=> $time,

    //     ]);

    // }

    // DB::table('orders')->where('id', $order_id)->update(['total'=> $total]);

}
