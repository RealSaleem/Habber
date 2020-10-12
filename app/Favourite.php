<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $fillable = ['user_id','book_id','bookmark_id'];

    public function books() {
        return $this->hasMany(Book::class,'id','book_id');
    }

    public function bookmarks() {
        return $this->hasMany(Bookmark::class,'id','bookmark_id');
    }

    public function users() {
        return $this->belongsTo(User::class,'id','user_id');
    }
}
