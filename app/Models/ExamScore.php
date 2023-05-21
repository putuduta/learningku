<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamScore extends Model
{
    use HasFactory;

    protected $table = "exam_scores";
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'student_user_id', 'id')->withDefault();
    }

    public function classSubject(){
        return $this->belongsTo(ClassSubject::class);
    }
}
