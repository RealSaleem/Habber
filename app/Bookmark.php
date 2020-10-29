<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    public function businesses() {
        return $this->belongsTo('App\Business','business_id','id');
    }

    public function banners() {
        return $this->hasMany('App\Banner');
    }

    // public function favourites()
    // {
    //     return $this->belongsToMany(Favourite::class);
    // }
}
