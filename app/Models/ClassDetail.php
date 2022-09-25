<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassDetail extends Model
{
    use HasFactory;
    protected $table = 'class_details';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function student(){
        return $this->hasMany('App\Models\User','id','student_id')->withDefault();
    }

    public function classHeader(){
        return $this->hasOne('App\Models\ClassHeader','id','class_header_id');
    }
}
