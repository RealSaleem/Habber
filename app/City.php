<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function countries() {
        return $this->belongsTo(Country::class,'country_id','id');
    }

    public function addresses()
    {
        return $this->belongsTo(Address::class,'id','city_id');
    }

}
