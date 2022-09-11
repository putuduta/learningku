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

    public function homeroom(){
        return $this->hasOne('App\Models\User','id','homeroom_id')->withDefault();
    }

    public function student(){
        return $this->hasMany('App\Models\User','class_id','id');
    }
}
