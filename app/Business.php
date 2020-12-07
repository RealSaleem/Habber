<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    public function users() {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function books() {
        return $this->hasMany('App\Book','id','business_id');
    }

    public function bookmarks() {
        return $this->hasMany('App\Bookmark','id','business_id');
    }
    
    
}
