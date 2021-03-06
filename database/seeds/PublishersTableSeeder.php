<?php

use Illuminate\Database\Seeder;

class PublishersTableSeeder extends BaseSeeder
{
    public function run()
    {
        factory('App\Publisher', $this->getPublishersNumber())->create();

        factory('App\Publisher')->create([
            'publisher'=> 'Cvetkovic Nemanja'
        ]);
    }

}
