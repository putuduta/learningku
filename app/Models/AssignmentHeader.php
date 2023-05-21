<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignmentHeader extends Model
{
    use HasFactory;
    protected $table = 'assignment_headers';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function submission()
    {
        return $this->hasMany('App\Models\AssignmentDetail', 'assignment_header_id', 'id');
    }

    public function submissionUser()
    {
        return $this->submission()->where('student_user_id', auth()->user()->id);
    }
    
    public function assignmentScores(){
        return $this->hasMany('App\Models\AssignmentScore', 'assignment_header_id', 'id');
    }

}
