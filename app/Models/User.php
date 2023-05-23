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
    protected $table = 'user';
    protected $primaryKey = 'user_id';
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
        'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function role(){
        return $this->belongsTo('App\Models\Role', 'role_id','role_id');
    }

    public function teacherManageClass(){
        return $this->hasMany('App\Models\ClassHeader', 'teacher_user_id','id');
    }

    public function studentClass(){
        return $this->hasMany('App\Models\ClassDetail', 'student_user_id','id');
    }

    public function assignmentSubmissions(){
        return $this->hasMany('App\Models\AssignmentDetail', 'student_user_id','id');
    }

    public function assignmentScores(){
        return $this->hasMany('App\Models\AssignmentScore', 'student_user_id','id');
    }

    public function examScores(){
        return $this->hasMany('App\Models\ExamScore', 'student_user_id','id');
    }
    
    public function forums(){
        return $this->hasMany('App\Models\Forums', 'user_id','id');
    }

    public function forumReplies(){
        return $this->hasMany('App\Models\ReplyForum', 'user_id','id');
    }

    public function attendances(){
        return $this->hasMany('App\Models\AttendanceDetail', 'student_user_id','id');
    }

    public function teacherSubjectsTeach(){
        return $this->hasMany('App\Models\ClassSubject', 'teacher_user_id','id');
    }
}
