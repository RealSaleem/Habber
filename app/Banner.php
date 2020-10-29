<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['image','id','description','sort_order'];

    public function languages () {
        return $this->belongsTo('App\Language','language_id','id');
    }
  
    public function books() {
        return $this->belongsTo('App\Book','book_id','id');
    }

    public function bookmarks(){
        return $this->belongsTo('App\Bookmark', 'bookmark_id','id');
    }
    
    public function bookclubs(){
        return $this->belongsTo('App\Bookclub','bookclub_id','id' );
    }
}
