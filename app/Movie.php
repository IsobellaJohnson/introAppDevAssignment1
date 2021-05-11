<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //use HasFactory;

    protected $table = 'movies';
    protected $fillable=['title', 'year', 'director', 'genre', 'reviewer_id', 'rating_id'];
    public $timestamps = false;
    // protected $appends = ['rating_count'];
    
    public function reviewers(){
        return $this->belongsTo(Reviewer::class, 'reviewer_id');
    }
    public function ratings(){
        return $this->belongsTo(Rating::class, 'rating_id');
    }
}
