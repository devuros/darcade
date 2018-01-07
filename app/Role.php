<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

	/**
	 * Get the users who the given role
	 */
    public function users()
    {

    	return $this->belongsToMany('App\User');

    }

}
