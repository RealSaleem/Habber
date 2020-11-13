<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','total_price','total_quantity','status'];


    public function books() {
        return $this->belongsToMany(Book::class,'order_product','order_id','product_id')->where('product_type','book')->withPivot('quantity','price','product_type');
    }

    public function bookmarks() {
        return $this->belongsToMany(Bookmark::class,'order_product','order_id','product_id')->where('product_type','bookmark')->withPivot('quantity','price','product_type');
    }
}
