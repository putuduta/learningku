<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignmentScore extends Model
{
    use HasFactory;

    protected $table = "assignment_scores";
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'student_user_id', 'id')->withDefault();
    }

    public function assignmentHeader(){
        return $this->belongsTo(AssignmentHeader::class);
    }

    // public function class_course()
    // {
    //     return $this->belongsTo('App\Models\ClassCourse', 'class_header_id', 'id')->withDefault();
    // }
}
