<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignmentDetail extends Model
{
    use HasFactory;

    protected $table = 'assignment_details';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo('App\Models\User', 'student_user_id', 'id');
    }
}
