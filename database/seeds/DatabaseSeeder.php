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
        'games',

	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->cleanDatabase();

        $this->call([

            RolesTableSeeder::class,

            UsersTableSeeder::class,

            DevelopersTableSeeder::class,

            PublishersTableSeeder::class,

            GenresTableSeeder::class,

            RoleUserTableSeeder::class,

            GamesTableSeeder::class,

        ]);

    }

    public function cleanDatabase()
    {

        foreach ($this->tables as $tableName) {

            DB::table($tableName)->truncate();

        }

    }

}
