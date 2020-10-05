<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestForBook extends Model
{
    protected $fillable = ['user_id','title','author_name','image_path'];
    protected $table="user_requests";
    
    public function users() {
        return $this->belongsTo('App\User');
    }
}
