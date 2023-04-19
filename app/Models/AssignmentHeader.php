<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignmentHeader extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'assignment_headers';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function submission()
    {
        return $this->hasMany('App\Models\AssignmentDetail', 'assignment_header_id', 'id');
    }

    public function submissionUser()
    {
        return $this->submission()->where('student_user_id', auth()->user()->id);
    }
    
    public function assignment_scores(){
        return $this->hasMany('App\Models\AssignmentScore', 'assignment_header_id', 'id');
    }

}
