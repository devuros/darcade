<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

    //

    public function genres()
    {

    	return $this->belongsToMany('App\Genre');

    }

    public function screenshots()
    {

    	return $this->hasMany('App\Screenshot');

    }

}
