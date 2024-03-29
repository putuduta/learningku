<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{

    protected $table = 'forum';
    protected $primaryKey = 'forum_id';
    protected $guarded = [];

    public function replies()
    {
        return $this->hasMany('App\Models\ReplyForum', 'forum_id', 'forum_id');
    }

    public function replyAuthUser()
    {
        return $this->replies()->where('user_id', auth()->user()->user_id);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }

    public function classSubject(){
        return $this->belongsTo('App\Models\ClassSubject','class_subject_id','id');
    }
}
