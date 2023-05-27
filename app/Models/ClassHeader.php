<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ClassHeader extends Model
{

    protected $table = 'class_header';
    protected $primaryKey = 'class_header_id';
    protected $guarded = [];
    
    public function homeroomTeacher(){
        return $this->belongsTo('App\Models\User','user_id','user_id');
    }

    public function schoolYear(){
        return $this->belongsTo('App\Models\SchoolYear','school_year_id','school_year_id');
    }

    public function details(){
        return $this->hasMany('App\Models\ClassDetail','class_header_id','class_header_id');
    }
}
