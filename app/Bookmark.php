<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    public function users() {
        return $this->belongsTo('App\User','user_id','id');
    }
    public function bookmarkAddedBy() {
        return $this->belongsTo('App\User','added_by','id');
    }

    public function banners() {
        return $this->hasMany('App\Banner');
    }

    // public function favourites()
    // {
    //     return $this->belongsToMany(Favourite::class);
    // }

 
    
    public function product_prices() {
        return $this->hasOne('App\ProductPrice',"product_id","id")->where('product_type',"bookmark");
    }
}
