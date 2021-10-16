<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessingFee extends Model
{
   protected $guarded = [];

    public  function students(){
        return $this->belongsTo('App\Models\student','student_id');
    }
}
