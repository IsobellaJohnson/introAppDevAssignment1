<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{


    protected $table = 'movies';
    protected $fillable=['title', 'year', 'director', 'genre', 'reviewer_id', 'rating_id'];
    public $timestamps = false; //removed timestamps for readability
   
    
    public function reviewers(){
        return $this->belongsTo(Reviewer::class, 'reviewer_id');
    }
    public function ratings(){
        return $this->belongsTo(Rating::class, 'rating_id');
    }
}
