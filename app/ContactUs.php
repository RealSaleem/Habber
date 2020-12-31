<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected  $fillable = ['name','email','phone','message','whatapp_number'];
}
