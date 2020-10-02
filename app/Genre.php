<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public function books() {
        return $this->belongsTo(Book::class);
    }
}
