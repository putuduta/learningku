<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceDetail extends Model
{
    use HasFactory;

    protected $table = 'attendance_details';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function student()
    {
        return $this->hasOne('App\Models\Student', 'id', 'student_user_id')->withDefault();
    }

    public function header()
    {
        return $this->belongsTo('App\Models\AttendanceHeader', 'attendance_id', 'id');
    }
}
