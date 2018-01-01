<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

	/**
	 * Get the user who made the order
	 */
    public function user()
    {

    	return $this->belongsTo('App\User');

    }

    /**
     * Get the games that belong to this order
     */
    public function purchases()
    {

    	return $this->hasMany('App\Purchase');

    }

}
