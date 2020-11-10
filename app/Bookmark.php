<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    public function users() {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function banners() {
        return $this->hasMany('App\Banner');
    }

    // public function favourites()
    // {
    //     return $this->belongsToMany(Favourite::class);
    // }

 
    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_products')->where('product_type','bookmark')->withPivot('quantity','price');
    }

    public function product_prices() {
        return $this->hasOne('App\ProductPrice',"product_id","id")->where('product_type',"bookmark");
    }
}
