<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

	/**
	 * Get the items in the requested user's cart
	 */
    public function scopeUserCart($query, $user)
    {

    	return $query->where('user_id', $user);

    }


}
