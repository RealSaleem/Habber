<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookClub extends Model
{
    protected $table="book_clubs";


    public function books() {
        return $this->hasOne('App\Book');
    }

    public function banners() {
        return $this->hasMany('App\Banner');
    }
}
