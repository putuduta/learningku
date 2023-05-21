<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
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
        'user_code',
        'name',
        'email',
        'role_id',
        'photo_profile',
        'password',
        'gender'
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

    public function teacherManageClass(){
        return $this->hasMany('App\Models\ClassHeader', 'teacher_user_id','id')->withDefault();
    }

    public function studentClass(){
        return $this->hasMany('App\Models\ClassDetail', 'student_user_id','id')->withDefault();
    }

    public function teacherSubjectTeach(){
        return $this->hasMany('App\Models\ClassSubject', 'teacher_user_id','id')->withDefault();
    }
}
