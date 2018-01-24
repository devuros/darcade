<?php

use Illuminate\Database\Seeder;

class DevelopersTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory('App\Developer', $this->getDevelopersNumber())->create();

        factory('App\Developer')->create([

            'developer'=> 'Cvetkovic Nemanja'

        ]);

    }
}
