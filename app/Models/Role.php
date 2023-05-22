<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $primaryKey = 'role_id';
    protected $guarded = [];

    public function users(){
        return $this->hasMany('App\Models\User', 'role_id','id');
    }
}
