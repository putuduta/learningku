<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassSubject extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'class_subjects';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    
    public function teacher(){
        return $this->hasOne('App\Models\User','id','teacher_user_id')->withDefault();
    }
}
