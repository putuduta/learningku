<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AssignmentScore extends Model
{
    use HasFactory;

    protected $table = "assignment_scores";
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo('App\Models\User', 'student_user_id', 'user_id');
    }

    public function assignment(){
        return $this->belongsTo('App\Models\AssignmentHeader', 'assignment_header_id', 'id');
    }
}
