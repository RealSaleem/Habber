<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public function users()
    {
        return $this->hasOne('App\User','currency_id','id');
    }
}
