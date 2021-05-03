<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviewer extends Model
{
    protected $table = "reviewers";
    protected $fillable=['name'];

    public function ratings(){
        return $this->hasOne(Rating::class);
    }
    public function getRatingCountAttribute(){
        return $this->ratings()->count();
    }
}
