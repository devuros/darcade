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

    public function scopeUserOrders($query, $user)
    {
    	return $query->where('user_id', $user);
    }

    public function scopePriceAsc($query)
    {
    	return $query->orderBy('total', 'asc');
    }

    public function scopePriceDesc($query)
    {
    	return $query->orderBy('total', 'desc');
    }

    public function scopeLatestOrders($query)
    {
    	return $query->latest();
    }

    public function scopeOldestOrders($query)
    {
    	return $query->oldest();
    }

}
