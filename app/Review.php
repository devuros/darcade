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

    /**
     * Get the game this review belongs to
     */
    public function game()
    {

    	return $this->belongsTo('App\Game');

    }

    /**
     * Get the author of the review
     */
    public function author()
    {

    	return $this->belongsTo('App\User', 'user_id', 'id');

    }

}
