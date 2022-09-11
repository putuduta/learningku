<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyThread extends Model
{
    use HasFactory;
    protected $table = 'reply_threads';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function thread()
    {
        return $this->belongsTo('App\Models\Thread', 'thread_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
