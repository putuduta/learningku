<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceHeader extends Model
{
    use HasFactory;

    protected $table = 'attendance_headers';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function classSubject(){
        return $this->hasOne('App\Models\ClassSubject','id','class_subject_id')->withDefault();
    }

    public function details(){
        return $this->hasMany('App\Models\AttendanceDetail','attendance_header_id','id');
    }
}
