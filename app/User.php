<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['created_at'=> 'string'];

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

    public function purchases()
    {
        return $this->hasManyThrough('App\Purchase', 'App\Order');
    }

    public function userPurchases()
    {
        return $this->purchases()
            ->join('games', 'purchases.game_id', '=', 'games.id')
            ->latest()
            ->select('purchases.*', 'orders.created_at', 'games.title', 'games.id as game_id');
    }

    public function recommendedReviews()
    {
        return $this->reviews()->where('recommended', 1);
    }

    public function isAdmin()
    {
        return $this->roles()->where('role', 'admin')->exists();
    }

}
