<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $guarded = [];
    
	protected $hidden = ['created_at', 'updated_at'];
	
    public function comments()
    {
    	return $this->hasMany('App\models\FilmComment');
    }

    public function ratings()
    {
    	return $this->hasMany('App\models\FilmRating');
    }

    public function country()
    {
    	return $this->belongsTo('App\models\Country');
    }

    public function genre()
    {
    	return $this->belongsTo('App\models\Genre');
    }
}
