<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnlineClasse extends Model
{

    protected $guarded = [];


    public  function grade(){
        return $this->belongsTo('App\Models\Grade','Grade_id');
    }
    public  function classroom(){
        return $this->belongsTo('App\Models\Classroom','Classroom_id');
    }
    public  function section(){
        return $this->belongsTo('App\Models\Section','section_id');
    }
    public  function users(){
        return $this->belongsTo('App\User','user_id');
    }
}
