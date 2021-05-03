<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //use HasFactory;

    protected $table = 'movies';
    protected $fillable=['title', 'year', 'director', 'genre'];
    protected $appends = ['rating_count'];
    
    public function ratings(){
        return $this->hasOne(Rating::class); //hasMany??
    }
    public function getRatingCountAttribute(){
        return $this->ratings()->count();
    }
}
