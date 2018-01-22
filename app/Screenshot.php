<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Screenshot extends Model
{

    public function game()
    {

    	return $this->belongsTo('App\Game');

    }

    /**
     * Get all the game's screenshots
     */
    public function scopeGameScreenshots($query, $game)
    {

    	return $query->where('game_id', $game);

    }

}
