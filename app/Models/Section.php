<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Grade;
use App\Models\Classroom;

class Section extends Model
{
    use HasTranslations;

    protected $table = 'Sections';
    protected $fillable = ['Name_section','Grade_id','Class_id'];
    public $translatable = ['Name_section'];

    public $timestamps = true;

    public function Grades()
    {
        return $this->belongsTo('Grade', 'Grade_id');
    }

    public function Myclasses()
    {
        return $this->belongsTo('App\Models\Classroom', 'class_id');
    }

}
