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
    public function bookmark_size() {
        return $this->hasOne('App\Size','bookmark_size','id');
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

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product','product_id','order_id')->where('product_type','bookmark')->withPivot('quantity','price','product_type');
    }

    public function product_prices() {
        return $this->hasMany('App\ProductPrice',"product_id","id")->where('product_type',"bookmark")->with('currency');
    }
}
