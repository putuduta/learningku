<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'role_id',
        'photo_profile',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->hasOne('App\Models\Role', 'id','role_id')->withDefault();
    }

    public function teacherclass(){
        return $this->hasMany('App\Models\ClassHeader', 'teacher_id','id')->withDefault();
    }

    public function studentClass(){
        return $this->hasMany('App\Models\ClassDetail', 'student_id','id')->withDefault();
    }

    // public function classes(){
    //     return $this->belongsToMany('App\Models\ClassHeader');
    // }

    public function studentRequestClass(){
        return $this->hasMany('App\Models\RequestClass','student_id','id')->withDefault();
    }
}
