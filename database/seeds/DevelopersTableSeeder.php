<?php

use Illuminate\Database\Seeder;

class DevelopersTableSeeder extends BaseSeeder
{
    public function run()
    {
        factory('App\Developer', $this->getDevelopersNumber())->create();

        factory('App\Developer')->create([
            'developer'=> 'Cvetkovic Nemanja'
        ]);
    }

}
