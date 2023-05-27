<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    protected $table = 'class_subject';
    protected $primaryKey = 'class_subject_id';
    protected $guarded = [];

    public function teacher(){
        return $this->belongsTo('App\Models\User','user_id','user_id'); 
    }

    public function examScores(){
        return $this->hasMany('App\Models\ExamScore', 'class_subject_id', 'class_subject_id');
    }

    public function materials(){
        return $this->hasMany('App\Models\Material', 'class_subject_id', 'class_subject_id');
    }

    public function assignments(){
        return $this->hasMany('App\Models\AssignmentHeader', 'class_subject_id', 'class_subject_id');
    }

    public function attendances(){
        return $this->hasMany('App\Models\Attendance', 'class_subject_id', 'class_subject_id');
    }

    public function forums(){
        return $this->hasMany('App\Models\Forum', 'class_subject_id', 'class_subject_id');
    }

    public function class(){
        return $this->belongsTo('App\Models\ClassHeader', 'class_header_id', 'class_subject_id');
    }
}
