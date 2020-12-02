<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','total_price','total_quantity','address_id','status'];


    public function books() {
        return $this->belongsToMany(Book::class,'order_product','order_id','product_id')->where('product_type','book')->withPivot('quantity','price','product_type');
    }

    public function bookmarks() {
        return $this->belongsToMany(Bookmark::class,'order_product','order_id','product_id')->where('product_type','bookmark')->withPivot('quantity','price','product_type');
    }

    public function addresses() {
        return $this->belongsTo(Address::class,'address_id','id');
    }
    
    public function users() {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function currencies() {
        return $this->belongsTo(Currency::class,'currency_id','id');
    }

  

}

