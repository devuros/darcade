<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Screenshot extends Model
{

    //

	/**
	 * Get the game the screenshot belongs to
	 */
    public function game()
    {

    	return $this->belongsTo('App\Game');

    }

}
