<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AssignmentDetail extends Model
{
    use HasFactory;

    protected $table = 'assignment_detail';
    protected $primaryKey = 'assignment_detail_id';
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }
    
    public function assignmentHeader(){
        return $this->belongsTo('App\Models\AssignmentHeader','assignment_header_id','assignment_header_id');
    }
}
