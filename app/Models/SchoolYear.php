<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    protected $table = "school_year";
    protected $primaryKey = 'school_year_id';
    protected $guarded = [];

    public function classes(){
        return $this->hasMany('App\Models\ClassHeader', 'school_year_id','school_year_id');
    }
}
