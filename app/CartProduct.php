<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    //
    protected $table="cart_product";
    protected $fillable = ['cart_id','price','quantity','product_id'];
}
