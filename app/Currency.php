<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public function users()
    {
        return $this->hasOne('App\User','currency_id','id');
    }

    public function site_settings()
    {
        return $this->hasOne(SiteSetting::class,'currency_id','id');
    }
    public function orders()
    {
        return $this->hasOne('App\Order','currency_id','id');
    }
}
