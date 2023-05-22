<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AssignmentHeader extends Model
{
    use HasFactory;
    protected $table = 'assignment_headers';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function submissions()
    {
        return $this->hasMany('App\Models\AssignmentDetail', 'assignment_header_id', 'id');
    }

    public function submissionUser()
    {
        return $this->submissions()->where('student_user_id', auth()->user()->id);
    }
    
    public function scores(){
        return $this->hasMany('App\Models\AssignmentScore', 'assignment_header_id', 'id');
    }

    public function classSubject(){
        return $this->belongsTo('App\Models\ClassSubject','class_subject_id','id');
    }

}
