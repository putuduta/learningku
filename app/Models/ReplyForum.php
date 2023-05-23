<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyForum extends Model
{
    use HasFactory;

    protected $table = 'reply_forum';
    protected $primaryKey = 'reply_forum_id';
    protected $guarded = [];

    public function forum()
    {
        return $this->belongsTo('App\Models\Forum', 'forum_id', 'forum_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }
}
