<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignmentDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'assignment_details';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function student()
    {
        return $this->belongsTo('App\Models\User', 'student_user_id', 'id');
    }
}
