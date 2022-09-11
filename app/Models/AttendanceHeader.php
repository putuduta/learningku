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

    public function class(){
        return $this->hasOne('App\Models\ClassDetail','id','class_id')->withDefault();
    }

    public function details(){
        return $this->hasMany('App\Models\AttendanceDetail','attendance_id','id');
    }
}
