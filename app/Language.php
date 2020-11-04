<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['name','status'];

    public function banners () {
        
        return $this->hasMany('App\Banner');
    }

    public function users()
    {
       
        return $this->hasOne('App\User','language_id','id');
    }
    public function sitesettings()
    {
        return $this->hasOne(SiteSetting::class,'language','id');
    }
}
