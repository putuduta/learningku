<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    protected $table = "scores";
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id')->withDefault();
    }

    public function class_course()
    {
        return $this->belongsTo('App\Models\ClassCourse', 'class_course_id', 'id')->withDefault();
    }
}
