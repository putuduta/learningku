<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AttendanceHeader extends Model
{
    use HasFactory;

    protected $table = 'attendance_headers';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function classSubject(){
        return $this->belongsTo('App\Models\ClassSubject','class_subject_id','id');
    }

    public function details(){
        return $this->hasMany('App\Models\AttendanceDetail','attendance_header_id','id');
    }
}
