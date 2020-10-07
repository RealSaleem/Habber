<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function businesses() {
        return $this->belongsTo('App\Business');
    }

    public function genres() {
        return $this->belongsToMany('App\Genre');
    }
}
