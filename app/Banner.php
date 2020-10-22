<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['image','id','description','sort_order'];

    public function languages () {
        return $this->belongsTo('App\Language','language_id','id');
    }
}
