<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends BaseSeeder
{
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
