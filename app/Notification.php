<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    
        protected $table="notifications";
        protected  $fillable = ['order_id','publisher_id'];
    
}
