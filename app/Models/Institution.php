<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;
    protected $table = 'institutions';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function class(){
        return $this->hasMany('App\Models\ClassDetail','institution_id','id');
    }
}
