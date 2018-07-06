<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FilmRating extends Model
{
    protected $fillable= ['film_id', 'user_id', 'rating'];
    protected $hidden = ['created_at', 'updated_at'];

}
