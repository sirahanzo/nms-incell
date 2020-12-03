<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        //'name', 'email', 'password',
        'name', 'username', 'email', 'level', 'password','phone','role_id','owner_id','notification_id','region_oid'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','phone',
    ];


    /**
     * Automatically use bcrypt password as default encryption
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        if ($value != "") {
            $this->attributes['password'] = bcrypt($value);
        }
    }



}
