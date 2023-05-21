<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassSubject extends Model
{
    use HasFactory;

    protected $table = 'class_subjects';
    protected $primaryKey = 'id';
    protected $guarded = [];

    
    public function teacher(){
        return $this->hasOne('App\Models\User','id','teacher_user_id')->withDefault();
    }

    public function examScore(){
        return $this->hasMany('App\Models\ExamScore', 'class_subject_id', 'id');
    }
}
