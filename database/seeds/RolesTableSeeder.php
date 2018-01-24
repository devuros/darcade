<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->getRolesArray() as $role)
        {

            factory('App\Role')->create([

                'role'=> $role

            ]);

        }

    }
}
