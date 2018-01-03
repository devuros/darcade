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

    //

    /**
     * Get the content of the user's cart
     */
    public function cart()
    {

        return $this->belongsToMany('App\Game', 'carts');

    }

    /**
     * Get the games the user ownes
     */
    public function library()
    {

        return $this->belongsToMany('App\Game');

    }

    /**
     * Get the games the user wishes to own
     */
    public function wishes()
    {

        return $this->belongsToMany('App\Game', 'wishes');

    }

    /**
     * Get all the reviews the user wrote
     */
    public function reviews()
    {

        return $this->hasMany('App\Review');

    }

    /**
     * Get all of the user's orders
     */
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

}
