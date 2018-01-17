<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{

	public $timestamps = false;

	public function order()
	{

		return $this->belongsTo('App\Order');

	}

	public function game()
	{

		return $this->belongsTo('App\Game');

	}

}
