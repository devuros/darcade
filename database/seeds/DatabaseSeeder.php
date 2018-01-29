<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
	private $tables = [

        'roles',
        'users',
        'role_user',
		'developers',
        'publishers',
        'genres',

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

        Storage::disk('public')->deleteDirectory('games');
        Storage::disk('public')->deleteDirectory('screenshots');

        // Segment: one

        $this->call([

            RolesTableSeeder::class,

            UsersTableSeeder::class,

            RoleUserTableSeeder::class,

            DevelopersTableSeeder::class,

            PublishersTableSeeder::class,

            GenresTableSeeder::class

        ]);

        // Segment: two

        $this->call([

            GamesTableSeeder::class,

            GameGenreTableSeeder::class,

            ScreenshotsTableSeeder::class,

            CartsTableSeeder::class

        ]);

        // Segment: three

        $this->call([

            OrdersTableSeeder::class,

            WishesTableSeeder::class,

            ReviewsTableSeeder::class

        ]);

    }

    public function cleanDatabase()
    {

        foreach ($this->tables as $tableName)
        {

            DB::table($tableName)->truncate();

        }

    }

}
