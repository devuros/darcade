<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{

    /**
     * Get all of the publisher's games
     */
    public function games()
    {

    	return $this->hasMany('App\Game');

    }

}
