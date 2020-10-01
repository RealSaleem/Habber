<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ROLES = ['USER' => 3, 'ADMIN' => 1, 'SUB_ADMIN' => 2];
    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
