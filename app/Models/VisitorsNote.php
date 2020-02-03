<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorsNote extends Model
{
    protected $fillable=['added_by','user_id','visit_id','notes','note_date'];

    public function getRules($rule ='add'){
        return [
            'notes'=>'required|string',
            'note_date'=>'required|string',
        ];
    }
    public function getUserName(){
        return $this->hasOne('app\user','id','user_id');
    }

    public function getNameById(){
        return $this->with('getUserName')->orderBy('id','DESC')->get();
    }

}
