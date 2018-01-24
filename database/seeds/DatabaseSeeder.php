<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	private $tables = [

        'users',
		'developers',
        'publishers',
        'genres',

	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->cleanDatabase();

        // Users seeding

        $this->call(UsersTableSeeder::class);

        factory('App\User')->create([

            'name' => 'Uros Jovanovic',
            'email' => 'urosjovanovic0704@gmail.com',
            'password' => bcrypt('morja994')

        ]);

        factory('App\User')->create([

            'name' => 'Milos Radosavljevic',
            'email' => 'milos@example.com'

        ]);

        // Developers seeding

        $this->call(DevelopersTableSeeder::class);

        factory('App\Developer')->create([

            'developer'=> 'Cvetkovic Nemanja'

        ]);

        // Publishers seeding

        $this->call(PublishersTableSeeder::class);

        factory('App\Publisher')->create([

            'publisher'=> 'Cvetkovic Nemanja'

        ]);

        // Genres seeding

        $this->call(GenresTableSeeder::class);

    }

    public function cleanDatabase()
    {

        foreach ($this->tables as $tableName) {

            DB::table($tableName)->truncate();

        }

    }

}
