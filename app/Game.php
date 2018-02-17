<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Game extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $casts = [

        'is_on_sale'=> 'boolean',

    ];

    public function developer()
    {

    	return $this->belongsTo('App\Developer');

    }

    public function publisher()
    {

    	return $this->belongsTo('App\Publisher');

    }

    public function genres()
    {

    	return $this->belongsToMany('App\Genre');

    }

    public function screenshots()
    {

    	return $this->hasMany('App\Screenshot');

    }

    public function reviews()
    {

        return $this->hasMany('App\Review');

    }

    /**
     * Get games which are on sale
     */
    public function scopeOnSale($query)
    {

        return $query->where('is_on_sale', '1');

    }

    /**
     * Get games which are priced under 10
     */
    public function scopeUnderTen($query)
    {

        return $query->where('base_price', '<', 10)
            ->orWhere(function ($q)
            {
                $q->where('is_on_sale', '=', 1)
                    ->where('sale_price', '<', 10);
            });

    }

    /**
     * Get games which are priced under 25
     */
    public function scopeUnderTwentyFive($query)
    {

        return $query->where('base_price', '<', 25)
            ->orWhere(function ($q)
            {
                $q->where('is_on_sale', '=', 1)
                    ->where('sale_price', '<', 25);
            });

    }

    /**
     * Get games which are max one month old
     */
    public function scopeNewRelease($query)
    {

        $now = Carbon::now();
        $month = Carbon::now()->subMonths(1);

        return $query->whereBetween('release_date', [$month, $now]);

    }

    /**
     * Get all soft deleted games
     */
    public function scopeDeletedGames($query)
    {

        return $query->onlyTrashed();

    }

}
