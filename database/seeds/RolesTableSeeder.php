<?php

use Illuminate\Database\Seeder;

use App\User;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory('App\Role')->create([

			'role'=> 'user'

		]);

		factory('App\Role')->create([

			'role'=> 'admin'

		]);

		$timestamp = Carbon\Carbon::now();

		foreach (range(1, 10) as $index)
		{

            DB::table('role_user')->insert([

                'role_id'=> 1,
                'user_id'=> $index,
                'created_at'=> $timestamp,
                'updated_at'=> $timestamp,

            ]);

		}

    }
}
