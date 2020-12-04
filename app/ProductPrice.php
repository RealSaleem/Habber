<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    //
    public function books()
    {
        return $this->hasOne(Book::class,"product_id","id")->where('product_type','book');
    }

    public function bookmarks()
    {
        return $this->hasOne(Bookmark::class,"product_id","id")->where('product_type','bookmark');
    }

    public static function getPrice($product_id,$currency_id,$quantity,$product_type) {
        $price = $this::where('product_id',$product_id)->where('currency_id', $currency_id)->where('product_type',$product_type)->first();
        return $price->price * $quantity;
    }
}
