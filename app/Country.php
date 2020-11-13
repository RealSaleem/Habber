<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    public function addresses()
    {
        return $this->belongsTo(Address::class,'id','country_id');
    }

    public function publisher()
    {
        return $this->belongsTo(User::class,'id','country_id');
    }
}
