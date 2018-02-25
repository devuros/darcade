<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function scopeUserCart($query, $user)
    {
    	return $query->where('user_id', $user);
    }

}
