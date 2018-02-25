<?php

use Illuminate\Database\Seeder;
use App\User;

class RoleUserTableSeeder extends BaseSeeder
{
    public function run()
    {
        $timestamp = Carbon\Carbon::now();

		foreach (range(1, $this->getUsersNumber()) as $index)
		{
            DB::table('role_user')->insert([
                'role_id'=> 1,
                'user_id'=> $index,
                'created_at'=> $timestamp,
                'updated_at'=> $timestamp,
            ]);
		}

        // Attach role to Milos
        DB::table('role_user')->insert([
            'role_id'=> 1,
            'user_id'=> $this->getUsersNumber()+1,
            'created_at'=> $timestamp,
            'updated_at'=> $timestamp,
        ]);

        // Attach roles to Uros
        DB::table('role_user')->insert([
            'role_id'=> 1,
            'user_id'=> $this->getUsersNumber()+2,
            'created_at'=> $timestamp,
            'updated_at'=> $timestamp,
        ]);

        DB::table('role_user')->insert([
            'role_id'=> 2,
            'user_id'=> $this->getUsersNumber()+2,
            'created_at'=> $timestamp,
            'updated_at'=> $timestamp,
        ]);
    }

}
