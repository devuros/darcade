<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $owned_games = DB::table('game_user')
        	->select('game_id', 'user_id')
        	->get();

    	foreach ($owned_games as $owned_game)
    	{

    		if ($faker->boolean(80))
    		{

	    		$timestamp = Carbon\Carbon::now();

	    		DB::table('reviews')->insert([

	                'game_id'=> $owned_game->game_id,
	                'user_id'=> $owned_game->user_id,
	                'recommended'=> $faker->boolean(),
	                'body'=> $faker->paragraph(2),
	                'created_at'=> $timestamp,
	                'updated_at'=> $timestamp,

	            ]);

            }

    	}

    }
}
