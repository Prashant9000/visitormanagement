<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorsLog extends Model
{
    protected $fillable=['added_by','user_id','visit_date','purpose','followUp_status'];

    public function getRules($rule ='add'){
        return [
            'purpose'=>'required|string',
            'followUp_status'=>'required|in:Yes,No',
            'visit_date'=>'nullable|date',
        ];
    }

    public function getUserName(){
        return $this->hasOne('app\user','id','user_id');
    }

   

    public function getNameById(){
        return $this->with('getUserName')->orderBy('id','DESC')->get();
    }

   
}
