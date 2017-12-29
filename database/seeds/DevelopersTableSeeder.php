<?php

use Illuminate\Database\Seeder;

class DevelopersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory('App\Developer', 10)->create();

        // factory('App\Developer')->create([

        // 	'developer'=> 'Cvetkovic Nemanja'

        // ]);

    }
}
