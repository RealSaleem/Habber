<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function businesses() {
        return $this->belongsTo('App\Business','business_id','id');
    }

    public function genres() {
        return $this->belongsToMany('App\Genre');
    }

    // public function favourites()
    // {
    //     return $this->belongsToMany(Favourite::class);
    // }
}
