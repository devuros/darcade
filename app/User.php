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

    //

    /**
     * Get the games in the user's cart
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
     * Get all the user's reviews
     */
    public function reviews()
    {

        return $this->hasMany('App\Review');

    }

    /**
     * Get the user's purchase history
     */
    public function orders()
    {

        //

    }

}
