<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestForBook extends Model
{
    protected $table="user_requests";
    protected $fillable = ['user_id','title','author_name','image_path'];
    
    public function users() {
        return $this->belongsTo('App\User');
    }
}
