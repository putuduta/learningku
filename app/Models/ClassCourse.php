<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassCourse extends Model
{
    use HasFactory;
    protected $table = 'class_courses';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function course()
    {
        return $this->hasOne('App\Models\Course', 'id', 'course_id')->withDefault();
    }

    public function teacher()
    {
        return $this->hasOne('App\Models\User', 'id', 'teacher_id')->withDefault();
    }

    public function class()
    {
        return $this->hasOne('App\Models\ClassDetail', 'id', 'class_id')->withDefault();
    }
}
