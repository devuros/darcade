<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	private $tables = [

        'roles',
        'users',
		'developers',
        'publishers',
        'genres',
        'role_user',

	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->cleanDatabase();

        $this->call(RolesTableSeeder::class);

        $this->call(UsersTableSeeder::class);

        $this->call(DevelopersTableSeeder::class);

        $this->call(PublishersTableSeeder::class);

        $this->call(GenresTableSeeder::class);

        $this->call(RoleUserTableSeeder::class);

    }

    public function cleanDatabase()
    {

        foreach ($this->tables as $tableName) {

            DB::table($tableName)->truncate();

        }

    }

}
