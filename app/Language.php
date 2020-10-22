<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public function banners () {
        return $this->hasMany('App\Banner');
    }
}
