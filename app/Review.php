<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Review extends Pivot
{
    protected $table = 'reviews';

    protected $casts = [
        'created_at'=> 'string',
        'recommended'=> 'boolean'
    ];

    public function game()
    {
    	return $this->belongsTo('App\Game');
    }

    public function author()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function getCreatedAtColumn()
    {
        return 'created_at';
    }

    public function getUpdatedAtColumn()
    {
        return 'updated_at';
    }

    public function scopeRecommended($query)
    {
        return $query->where('recommended', 1);
    }

    public function scopeNotRecommended($query)
    {
        return $query->where('recommended', 0);
    }

    public function scopeUserReviews($query, $user)
    {
        return $query->where('user_id', $user);
    }

    public function scopeGameReviews($query, $game)
    {
        return $query->where('game_id', $game);
    }

}
