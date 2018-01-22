<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{

    /**
     * The Table associated with the model
     *
     * @var string
     */
    protected $table = 'game_user';

    /**
     * Get the games of the requested user
     */
    public function scopeUserLibrary($query, $user)
    {

    	return $query->where('user_id', $user);

    }

}
