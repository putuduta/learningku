<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;
    protected $table = 'threads';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function replies()
    {
        return $this->hasMany('App\Models\ReplyThread', 'thread_id', 'id');
    }

    public function replyAuthUser()
    {
        return $this->replies()->where('user_id', auth()->user()->id);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function class_course()
    {
        return $this->belongsTo('App\Models\ClassCourse', 'class_course_id', 'id');
    }
}
