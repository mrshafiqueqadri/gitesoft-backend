<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FilmComment extends Model
{
	protected $fillable= ['film_id', 'user_id', 'body'];
    protected $hidden = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
