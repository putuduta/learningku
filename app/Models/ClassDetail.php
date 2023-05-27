<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ClassDetail extends Model
{

    protected $table = 'class_detail';
    protected $primaryKey = 'class_detail_id';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id','user_id');
    }

    public function classHeader(){
        return $this->belongsTo('App\Models\ClassHeader','class_header_id','class_header_id');
    }
}
