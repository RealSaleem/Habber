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

     
}
