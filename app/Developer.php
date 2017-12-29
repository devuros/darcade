<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{

    //

    /**
     * Get all the games of the developer
     */
    public function games()
    {

    	return $this->hasMany('App\Game');

    }

}
