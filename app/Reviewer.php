<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviewer extends Model
{
    protected $table = "reviewers";
    protected $fillable=['first_name', 'last_name'];
    public $timestamps = false;

    // public function ratings(){
    //     return $this->hasOne(Rating::class);
    // }
    // public function getRatingCountAttribute(){
    //     return $this->ratings()->count();
    // }
}
