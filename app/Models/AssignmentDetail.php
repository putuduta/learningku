<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentDetail extends Model
{
    use HasFactory;
    protected $table = 'assignment_details';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
