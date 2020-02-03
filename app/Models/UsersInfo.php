<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersInfo extends Model
{
    protected $fillable=['address','land_line','mob_1','mob_2','added_by','user_id'];

    public function getRules($rule ='add'){
        return [
            'address'=>'required|string',
            'land_line'=>'nullable|string',
            'mob_1'=>'nullable|string',
            'mob_2'=>'nullable|string'
        ];
    }

    public function getUserName(){
        return $this->hasOne('app\user','id','user_id');
    }

    public function getNameById(){
        return $this->with('getUserName')->orderBy('id','DESC')->get();
    }
}
