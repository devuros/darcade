<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

}
