<?php

use Illuminate\Database\Seeder;

class PublishersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory('App\Publisher', 9)->create();

        factory('App\Publisher')->create([

        	'name'=> 'Cvetkovic Nemanja'

        ]);

    }
}
