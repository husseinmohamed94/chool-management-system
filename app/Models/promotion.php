<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class promotion extends Model
{
   protected $guarded = [];

    public  function students(){
        return $this->belongsTo('App\Models\student','student_id');
    }

    public  function f_grade(){
        return $this->belongsTo('App\Models\Grade','from_grade');
    }
    public  function f_classroom(){
        return $this->belongsTo('App\Models\Classroom','from_classroom');
    }
    public  function f_section(){
        return $this->belongsTo('App\Models\Section','from_setion');
    }

    public  function t_grade(){
        return $this->belongsTo('App\Models\Grade','to_grade');
    }
    public  function t_classroom(){
        return $this->belongsTo('App\Models\Classroom','to_classroom');
    }
    public  function t_section(){
        return $this->belongsTo('App\Models\Section','to_section');
    }
}
