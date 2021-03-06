<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email' , 'password','image',
    ];

    protected $appends = ['fullname'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
    
    public function userRequests()
    {
        return $this->hasMany(RequestForBook::class);
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class,'user_id','id');
    }

    public function businesses()
    {
        return $this->hasOne('App\Business');
    }

    public function countries() {
        return $this->belongsTo(Country::class,'country_id','id');
    }

    public function languages()
    {
        return $this->hasOne('App\Language','id','language_id');
    }

    public function currencies()
    {
        return $this->hasOne('App\Currency','id','currency_id');
    }

    public function books()
    {
        return $this->hasMany('App\Book');
    }
    public function bookmarks()
    {
        return $this->hasMany('App\Bookmark');
    }

    public function bookmarkAddedBy()
    {
        return $this->hasMany('App\Bookmark');
    }
    
    
    public function bookAddedBy()
    {
        return $this->hasMany('App\Books');
    }

    public function getFullNameAttribute() {
        return "{$this['first_name']} {$this['last_name']}";
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    


}