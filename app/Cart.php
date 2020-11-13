<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id','total_price'];
    public function books() {
        return $this->belongsToMany('App\Book','cart_product','cart_id','product_id')->where('product_type','book')->withPivot('quantity','price','product_type');
    }

    public function bookmarks() {
        return $this->belongsToMany('App\Bookmark','cart_product','cart_id','product_id')->where('product_type','bookmark')->withPivot('quantity','price','product_type');
    }

    
}
