<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AttendanceDetail extends Model
{
    use HasFactory;

    protected $table = 'attendance_detail';
    protected $primaryKey = 'attendance_detail_id';
    protected $guarded = [];
    
    public function student()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }

    public function attendanceHeader()
    {
        return $this->belongsTo('App\Models\AttendanceHeader', 'attendance_header_id', 'attendance_detail_id');
    }
}
