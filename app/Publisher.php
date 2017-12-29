<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{

    //

    /**
     * Get all the games of the publisher
     */
    public function games()
    {

    	return $this->hasMany('App\Game');

    }

}
