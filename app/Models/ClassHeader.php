<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ClassHeader extends Model
{
    use HasFactory;

    protected $table = 'class_headers';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function homeroomTeacher(){
        return $this->belongsTo('App\Models\User','id','homeroom_teacher_user_id');
    }

    public function schoolYear(){
        return $this->belongsTo('App\Models\SchoolYear','school_year_id','id');
    }

    public function details(){
        return $this->hasMany('App\Models\ClassDetail','class_header_id','id');
    }
}
