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

        $games = range(1, $this->getGamesNumber());

        $orders = $this->getOrdersPerUser();

        $purchases = $this->getPurchasesPerOrder();

        $timestamp = Carbon\Carbon::now();

        DB::transaction(function () use ($users, $games, $orders, $purchases, $timestamp)
        {

            foreach (range(1, $users) as $user)
            {

                // number of orders that will be seeded for the user

                $user_orders = array_random($orders);

                if ($user_orders == 0)
                {
                    continue;
                }

                foreach (range(1, $user_orders) as $order_index)
                {

                    // number of purchases that will be seeded for the order

                    $order_purchases = array_random($purchases);

                    $total = 0;

                    $order_id = DB::table('orders')->insertGetId([

                        'user_id'=> $user,
                        'total'=> $total,
                        'created_at'=> $timestamp,
                        'updated_at'=> $timestamp,

                    ]);

                    foreach (range(1, $order_purchases) as $purchase_index)
                    {

                        // game that will be seeded in purchases and library

                        $random_game = array_random($games);

                        // get game details

                        $game = App\Game::find($random_game);

                        $actual_price = $game->base_price;

                        if ($game->is_on_sale)
                        {

                            $actual_price = $game->sale_price;

                        }

                        $total += $actual_price;

                        DB::table('purchases')->insert([

                            'game_id'=> $random_game,
                            'order_id'=> $order_id,
                            'actual_price'=> $actual_price,

                        ]);

                        DB::table('game_user')->insert([

                            'game_id'=> $random_game,
                            'user_id'=> $user,
                            'created_at'=> $timestamp,
                            'updated_at'=> $timestamp,

                        ]);

                    }

                    DB::table('orders')->where('id', $order_id)->update(['total'=> $total]);

                }

            }

        });

    }

}
