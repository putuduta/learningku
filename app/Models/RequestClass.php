<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestClass extends Model
{
    use HasFactory;
    protected $table = 'request_classes';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function student(){
        return $this->hasOne('App\Models\User','id','student_id')->withDefault();
    }
    public function classHeader(){
        return $this->hasOne('App\Models\ClassHeader','id','class_id')->withDefault();
    }
}
