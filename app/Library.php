<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $table = 'game_user';

    public function scopeUserLibrary($query, $user)
    {
    	return $query->where('user_id', $user);
    }

}
