<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['address_name','country_id','post_code','address_line1','address_line2','city','state','user_id','phone'];
    public function users() {
        return $this->belongsTo(User::class);
    }

    public function countries() {
        return $this->belongsTo(Country::class,'country_id','id');
    }
}
