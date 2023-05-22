<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyForum extends Model
{
    use HasFactory;

    protected $table = 'reply_forums';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function forum()
    {
        return $this->belongsTo('App\Models\Forum', 'forum_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
