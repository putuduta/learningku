<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AssignmentScore extends Model
{
    use HasFactory;

    protected $table = "assignment_score";
    protected $primaryKey = 'assignment_score_id';
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }

    public function assignment(){
        return $this->belongsTo('App\Models\AssignmentHeader', 'assignment_header_id', 'assignment_header_id');
    }
}
