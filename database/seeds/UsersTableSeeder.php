<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	factory('App\User', $this->getUsersNumber())->create();

    	factory('App\User')->create([

            'name' => 'Uros Jovanovic',
            'email' => 'urosjovanovic0704@gmail.com',
            'password' => bcrypt('morja994')

        ]);

        factory('App\User')->create([

            'name' => 'Milos Radosavljevic',
            'email' => 'milos@example.com'

        ]);

    }
}
