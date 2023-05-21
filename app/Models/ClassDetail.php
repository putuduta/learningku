<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassDetail extends Model
{
    use HasFactory;

    protected $table = 'class_details';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function student(){
        return $this->hasMany('App\Models\User','id','student_user_id')->withDefault();
    }

    public function classHeader(){
        return $this->hasOne('App\Models\ClassHeader','id','class_header_id');
    }
}
