<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role','status','added_by'
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

    public function getRules($rule ='add'){
        return [
            'name'=>'required|string',
            'email'=>(($rule=='add')?'required':'nullable').'|email|'.($rule=='add')?'unique:users,email' : '',
            'role'=>'required|in:admin,superAdmin,student,visitor',
            'status'=>'required|in:active,inactive',
            'password'=>(($rule=='add')?'required':'nullable').'|string|confirmed'
        ];
    }

    public function getUpdate(){
        return [
            'name'=>'required|string',
            'email'=>'nullable|email',
            'role'=>'required|in:admin,superAdmin,student,visitor',
            'status'=>'required|in:active,inactive',
        ];
    }

  

}
