<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AssignmentDetail extends Model
{
    use HasFactory;

    protected $table = 'assignment_details';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'student_user_id');
    }
    
    public function assignmentHeader(){
        return $this->belongsTo('App\Models\AssignmentHeader','assignment_header_id','id');
    }
}
