<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';
    protected $fillable = ['rating', 'ratingDate'];
    public $timestamps = false; //removed timestamps for readability
    
}

