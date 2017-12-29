<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{

    //

	/**
	 * Get all the games assosiated with the genre
	 */
    public function games()
    {

    	return $this->belongsToMany('App\Game');

    }

}
