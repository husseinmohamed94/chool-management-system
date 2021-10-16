<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    public  function students(){
        return $this->belongsTo('App\Models\student','student_id');
    }
}
