<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    public function users() {
        return $this->belongsTo('App\User');
    }

    public function books() {
        return $this->hasMany('App\Book');
    }

    public function bookmarks() {
        return $this->hasMany('App\Bookmark');
    }
}
