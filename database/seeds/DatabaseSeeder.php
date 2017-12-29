<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	private $tables = [

		'games',
        'game_genre',
        'wishes',
        'screenshots',
        'reviews',
        'carts'

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

        // $this->call(GenresTableSeeder::class);

        // $this->call(DevelopersTableSeeder::class);

        // $this->call(PublishersTableSeeder::class);

        $this->call(GamesTableSeeder::class);

        $this->call(GameGenreTableSeeder::class);

        $this->call(WishesTableSeeder::class);

        $this->call(ScreenshotsTableSeeder::class);

        // $this->call(ReviewsTableSeeder::class);

        $this->call(CartsTableSeeder::class);

    }

    public function cleanDatabase()
    {

        foreach ($this->tables as $tableName) {

            DB::table($tableName)->truncate();

        }

    }

}
