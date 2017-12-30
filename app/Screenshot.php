<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Screenshot extends Model
{

	/**
	 * Get the parent of the screenshot
	 */
    public function game()
    {

    	return $this->belongsTo('App\Game');

    }

}
