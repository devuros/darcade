<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

    /**
     * Get the game's developer
     */
    public function developer()
    {

    	return $this->belongsTo('App\Developer');

    }

    /**
     * Get the game's publisher
     */
    public function publisher()
    {

    	return $this->belongsTo('App\Publisher');

    }

    /**
     * Get the genres assosiated with the game
     */
    public function genres()
    {

    	return $this->belongsToMany('App\Genre');

    }

    /**
     * Get the game's screenshots
     */
    public function screenshots()
    {

    	return $this->hasMany('App\Screenshot');

    }

    /**
     * Get all the game's reviews
     */
    public function reviews()
    {

        return $this->hasMany('App\Review');

    }

}
