<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    public function businesses() {
        return $this->belongsTo('App\Business','business_id','id');
    }

    // public function favourites()
    // {
    //     return $this->belongsToMany(Favourite::class);
    // }
}
