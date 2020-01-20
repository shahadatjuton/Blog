<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id','name','email', 'password',
    ];

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

    //=============role model=====================

    public function role(){
        return $this->belongsTo(Role::class);
    }
    //==============role model model================
    public function posts(){
      return $this->hasMany('App\Post');

    }


    public function favourite_posts(){
        return $this->belongsToMany('App\Post')->withTimestamps();
    }


    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function scopeAuthor($query){
        return $query->where('role_id',2);
    }



}
