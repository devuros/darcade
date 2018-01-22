<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public function user()
    {

    	return $this->belongsTo('App\User');

    }

    public function purchases()
    {

    	return $this->hasMany('App\Purchase');

    }

    /**
     * Get all orders made by a user
     */
    public function scopeUserOrders($query, $user)
    {

    	return $query->where('user_id', $user);

    }

    /**
     * Add order by ascending to query
     */
    public function scopePriceAsc($query)
    {

    	return $query->orderBy('total', 'asc');

    }

    /**
     * Add order by descending to query
     */
    public function scopePriceDesc($query)
    {

    	return $query->orderBy('total', 'desc');

    }

    /**
     * Add order by date descending when the order was made
     */
    public function scopeLatestOrders($query)
    {

    	return $query->latest();

    }

    /**
     * Add order by date ascending when the order was made
     */
    public function scopeOldestOrders($query)
    {

    	return $query->oldest();

    }

}
