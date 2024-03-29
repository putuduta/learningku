<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamScore extends Model
{

    protected $table = "exam_score";
    protected $primaryKey = 'exam_score_id';
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }

    public function classSubject(){
        return $this->belongsTo('App\Models\ClassSubject','class_subject_id','id');
    }
}
