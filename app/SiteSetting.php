<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    //
    public function languages() {
        return $this->belongsTo('App\Language','language','id');
    }
}
