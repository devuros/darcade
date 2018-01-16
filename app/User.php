<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [

        'created_at'=> 'string'

    ];

    public function roles()
    {

        return $this->belongsToMany('App\Role');

    }

    public function cart()
    {

        return $this->belongsToMany('App\Game', 'carts');

    }

    public function library()
    {

        return $this->belongsToMany('App\Game');

    }

    public function wishes()
    {

        return $this->belongsToMany('App\Game', 'wishes');

    }

    public function reviews()
    {

        return $this->hasMany('App\Review');

    }

    public function orders()
    {

        return $this->hasMany('App\Order');

    }

    /**
     * Get all purchases for all orders made by the user
     */
    public function purchases()
    {
        return $this->hasManyThrough('App\Purchase', 'App\Order')
            ->join('games', 'purchases.game_id', '=', 'games.id')
            ->latest()
            ->select('purchases.*', 'orders.created_at', 'games.title');

    }

    /**
     * Get user's recommended reviews
     */
    public function recommendedReviews()
    {

        return $this->reviews()->where('recommended', 1);

    }

    /**
     * Get purchases under the given price
     */
    public function purchasesUnder($price)
    {

        return $this->purchases()->where('actual_price', '<', $price)->get();

    }

    /**
     * Check if user has administrator role
     */
    public function isAdmin()
    {

        return $this->roles()->where('role', 'admin')->exists();

    }

}
