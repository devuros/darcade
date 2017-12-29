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

        factory('App\Developer', 9)->create();

        factory('App\Developer')->create([

        	'name'=> 'Cvetkovic Nemanja'

        ]);

    }
}
