<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

	/**
	 * Get the games in cart of the requested user
	 */
    public function scopeUser($query, $user)
    {

    	return $query->where('user_id', $user);

    }


}
