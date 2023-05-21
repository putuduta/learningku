<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassHeader extends Model
{
    use HasFactory;

    protected $table = 'class_headers';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function homeroom(){
        return $this->hasOne('App\Models\User','id','homeroom_teacher_user_id')->withDefault();
    }

    public function schoolYear(){
        return $this->hasOne('App\Models\SchoolYear','id','school_year_id')->withDefault();
    }

    public function classDetail(){
        return $this->hasMany('App\Models\ClassDetail','class_header_id','id')->withDefault();
    }
}
