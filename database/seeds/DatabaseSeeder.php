<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	private $tables = [

		'games',
        'game_genre',
        'screenshots',
        'carts',
        'orders',
        'purchases',
        'game_user',
        'wishes',
        'reviews',

	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->cleanDatabase();

        //
        // These tables will be seeded only once
        //

        // $this->call(UsersTableSeeder::class);
        // $this->call(GenresTableSeeder::class);
        // $this->call(DevelopersTableSeeder::class);
        // $this->call(PublishersTableSeeder::class);

        //
        // These tables will be seeded everytime
        //

        $this->call(GamesTableSeeder::class);

        $this->call(GameGenreTableSeeder::class);

        $this->call(ScreenshotsTableSeeder::class);

        $this->call(CartsTableSeeder::class);

        $this->call(OrdersTableSeeder::class);

        $this->call(WishesTableSeeder::class);

        $this->call(ReviewsTableSeeder::class);

    }

    public function cleanDatabase()
    {

        foreach ($this->tables as $tableName) {

            DB::table($tableName)->truncate();

        }

    }

}
