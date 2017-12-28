<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	private $tables = [

		'games',
        'genres',
        'game_genre',

	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->cleanDatabase();

        // $this->call(UsersTableSeeder::class);

    	$this->call([

            GamesTableSeeder::class,
            GenresTableSeeder::class,
            GameGenreTableSeeder::class,

        ]);

    }

    public function cleanDatabase()
    {

        foreach ($this->tables as $tableName) {

            DB::table($tableName)->truncate();

        }

    }

}
