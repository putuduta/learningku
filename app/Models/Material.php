<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'materials';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function class(){
        return $this->hasOne('App\Models\ClassHeader','id','class_id')->withDefault();
    }

    public function details(){
        return $this->hasMany('App\Models\AttendanceDetail','attendance_id','id');
    }
}
