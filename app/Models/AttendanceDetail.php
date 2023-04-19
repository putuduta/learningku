<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendanceDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'attendance_details';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];
	protected $dates = ['deleted_at'];
    
    public function student()
    {
        return $this->hasOne('App\Models\User', 'id', 'student_user_id')->withDefault();
    }

    public function header()
    {
        return $this->belongsTo('App\Models\AttendanceHeader', 'attendance_header_id', 'id');
    }
}
