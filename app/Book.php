<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function businesses() {
        return $this->belongsTo('App\Business','business_id','id');
    }

    public function genres() {
        return $this->belongsToMany('App\Genre','book_genre');
    }

    public function book_clubs() {
        return $this->belongsTo('App\BookClub','book_club_id','id');
    }
    public function banners() {
        return $this->hasMany('App\Banner');
    }
}
