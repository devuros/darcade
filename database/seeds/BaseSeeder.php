<?php

use Illuminate\Database\Seeder;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

class BaseSeeder extends Seeder
{

	// Roles

	protected $roles_array = [

		'user',
        'admin'

	];

	public function getRolesArray()
	{

		return $this->roles_array;

	}

	// Users

	protected $users_number = 5;

	public function getUsersNumber()
	{

		return $this->users_number;

	}

	// Developers

	protected $developers_number = 20;

	public function getDevelopersNumber()
	{

		return $this->developers_number;

	}

	// Publishers

	protected $publishers_number = 20;

	public function getPublishersNumber()
	{

		return $this->publishers_number;

	}

	// Genres

	protected $genres_array = [

		'Action',
		'Adventure',
		'Casual',
		'Indie',
		'Massively Multiplayer',
		'Racing',
		'RPG',
		'Simulation',
		'Sports',
		'Strategy'

	];

	public function getGenresArray()
	{

		return $this->genres_array;

	}

	// Games

	protected $games_number = 10;

	public function getGamesNumber()
	{

		return $this->games_number;

	}

	// Screenshots

	protected $screenshots_per_game = [1, 2];

	public function getScreenshotsPerGame()
	{

		return $this->screenshots_per_game;

	}

	// Carts

	protected $games_in_cart_per_user = [1, 2, 3];

	public function getGamesInCartPerUser()
	{

		return $this->games_in_cart_per_user;

	}

	// Orders, Purchases

	protected $orders_per_user = [0, 1, 2];

	public function getOrdersPerUser()
	{

		return $this->orders_per_user;

	}

	protected $purchases_per_order = [1, 2, 3];

	public function getPurchasesPerOrder()
	{

		return $this->purchases_per_order;

	}

	// Wishes

	protected $wishes_per_user = [0, 1, 3];

	public function getWishesPerUser()
	{

		return $this->wishes_per_user;

	}

	// Reviews

	protected $reviews_per_user = [0, 2, 4];

	public function getReviewsPerUser()
	{

		return $this->reviews_per_user;

	}

}
