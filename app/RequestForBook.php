<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestForBook extends Model
{
    protected $table="user_requests";
    protected $fillable = ['user_id','title','author_name','image','book_type','status'];
    
    public function users() {
        return $this->belongsTo('App\User','user_id','id');
    }
}
