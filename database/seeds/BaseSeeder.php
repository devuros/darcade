<?php

use Illuminate\Database\Seeder;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

class BaseSeeder extends Seeder
{

	protected $roles_array = [

		'user',
        'admin'

	];

	public function getRolesArray()
	{

		return $this->roles_array;

	}

	//

	protected $users_number = 40;

	public function getUsersNumber()
	{

		return $this->users_number;

	}

	//

	protected $developers_number = 20;

	public function getDevelopersNumber()
	{

		return $this->developers_number;

	}

	//

	protected $publishers_number = 20;

	public function getPublishersNumber()
	{

		return $this->publishers_number;

	}

	//

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

	//

	protected $games_number = 5;

	protected $default_game_image = new File('storage/app/favicon.ico');

	public function getGamesNumber()
	{

		return $this->games_number;

	}

	public function getDefaultGameImage()
	{

		return $this->default_game_image;

	}

	//

}
