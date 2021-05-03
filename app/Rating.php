<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';
    protected $fillable = ['rating', 'ratingDate', 'movie_id', 'reviewer_id'];

    public function movies(){
        return $this->belongsTo(Movie::class, 'movie_id');
    }
    public function reviewers(){
        return $this->belongsTo(Reviewer::class, 'reviewer_id');
    }
}

