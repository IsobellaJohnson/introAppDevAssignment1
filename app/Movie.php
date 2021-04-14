<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //use HasFactory;

    protected $table = 'movies';
    protected $fillable=['title', 'year', 'director', 'genre'];
    
    public function ratings(){
        return $this->hasMany(Rating::class);
    }
    public function getRatingCountAttribute(){
        return $this->ratings()->count();
    }
}
