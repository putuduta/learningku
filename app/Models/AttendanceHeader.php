<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AttendanceHeader extends Model
{

    protected $table = 'attendance_header';
    protected $primaryKey = 'attendance_header_id';
    protected $guarded = [];

    public function classSubject(){
        return $this->belongsTo('App\Models\ClassSubject','class_subject_id','class_subject_id');
    }

    public function details(){
        return $this->hasMany('App\Models\AttendanceDetail','attendance_header_id','attendance_header_id');
    }
}
