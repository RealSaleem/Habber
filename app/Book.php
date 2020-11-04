<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function users() {
        return $this->belongsTo('App\User','user_id','id');
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

    public function product_prices() {
        return $this->hasOne('App\ProductPrice',"product_id","id")->where('product_type',"book");
    }
}
