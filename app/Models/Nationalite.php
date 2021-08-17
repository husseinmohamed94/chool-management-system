<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Nationalite extends Model
{
    use HasTranslations;
    protected $fillable = ['Name'];
    public $translatable = ['Name'];

}
