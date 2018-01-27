<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Storage;

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
        'game_genre',
        'screenshots',
        'carts',
        'orders',
        'purchases',
        'game_user',

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

            // RolesTableSeeder::class,

            UsersTableSeeder::class,

            // DevelopersTableSeeder::class,

            // PublishersTableSeeder::class,

            // GenresTableSeeder::class,

            // RoleUserTableSeeder::class,

            GamesTableSeeder::class,

            // GameGenreTableSeeder::class,

            // ScreenshotsTableSeeder::class,

            // CartsTableSeeder::class,

            OrdersTableSeeder::class,

        ]);

    }

    public function cleanDatabase()
    {

        Storage::disk('public')->deleteDirectory('games');

        Storage::disk('public')->deleteDirectory('screenshots');

        foreach ($this->tables as $tableName)
        {

            DB::table($tableName)->truncate();

        }

    }

}
