<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		foreach (range(1, 40) as $index)
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
