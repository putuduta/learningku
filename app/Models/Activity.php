<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $table = 'activities';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function classCourse(){
        return $this->hasOne('App\Models\ClassCourse','id','class_course_id')->withDefault();
    }

}
