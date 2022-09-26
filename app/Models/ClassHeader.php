<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassHeader extends Model
{
    use HasFactory;
    protected $table = 'class_headers';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function teacher(){
        return $this->hasOne('App\Models\User','id','teacher_id')->withDefault();
    }

    public function classDetail(){
        return $this->hasMany('App\Models\ClassDetail','class_header_id','id')->withDefault();
    }

    public function requestClass(){
        return $this->hasMany('App\Models\RequestClass','class_id','id')->withDefault();
    }
}
