<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //
 
        protected $table="Log";
        protected $fillable = ['user_id','title','description'];
}
