<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    public function game()
    {
    	return $this->belongsTo('App\Game');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function scopeUserWishes($query, $user)
    {
    	return $query->where('user_id', $user);
    }

}
