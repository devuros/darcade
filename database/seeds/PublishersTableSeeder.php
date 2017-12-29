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

        factory('App\Publisher', 10)->create();

        // factory('App\Publisher')->create([

        // 	'publisher'=> 'Cvetkovic Nemanja'

        // ]);

    }
}
