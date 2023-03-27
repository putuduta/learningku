<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;
    protected $table = 'forums';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function replies()
    {
        return $this->hasMany('App\Models\ReplyForum', 'forum_id', 'id');
    }

    public function replyAuthUser()
    {
        return $this->replies()->where('user_id', auth()->user()->id);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
