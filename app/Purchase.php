<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{

	public $timestamps = false;

	/**
	 * Get the order of the purchase
	 */
	public function order()
	{

		return $this->belongsTo('App\Order');

	}

	/**
	 * Get the name of the game which was purchased
	 */
	public function game()
	{

		return $this->belongsTo('App\Game');

	}

}
