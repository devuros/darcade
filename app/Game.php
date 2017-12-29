<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

    //

    /**
     * Get the games developer
     */
    public function developer()
    {

    	return $this->belongsTo('App\Developer');

    }

    /**
     * Get the games publisher
     */
    public function publisher()
    {

    	return $this->belongsTo('App\Publisher');

    }

    /**
     * Get all the genres assosiated with the game
     */
    public function genres()
    {

    	return $this->belongsToMany('App\Genre');

    }

    /**
     * Get all the game's screenshots
     */
    public function screenshots()
    {

    	return $this->hasMany('App\Screenshot');

    }

}
