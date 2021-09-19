<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee_invoice extends Model
{
  protected $guarded = [];
    public  function students(){
        return $this->belongsTo('App\Models\student','student_id');
    }
    public  function grade(){
        return $this->belongsTo('App\Models\Grade','Grade_id');
    }
    public  function classroom(){
        return $this->belongsTo('App\Models\Classroom','Classroom_id');
    }
    public  function fees(){
        return $this->belongsTo('App\Models\fee','fee_id');
    }
}
