<?php

namespace App\Http\Controllers;

use App\Models\ClassDetail;
use App\Models\ClassHeader;
use App\Models\ClassSubject;
use App\Models\Material;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function view(){
        return view('dashboard.index');
    }

    public function viewClassDashboard($classId) {
        return view('dashboard.class', [
            'class' => ClassHeader::select('class_headers.id','class_headers.name','school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as homeroomTeacherName', 'class_headers.homeroom_teacher_id as homeroomTeacherId')
                ->join('school_years','school_years.id','class_headers.school_year_id')
                ->join('teachers', 'teachers.user_id', 'class_headers.homeroom_teacher_id')
                ->join('users', 'users.id', 'teachers.user_id')
                ->where('class_headers.id', $classId)
                ->first(),
            'subjects' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name','class_subjects.description as description','users.id as teacherId', 'users.name as teacherName')
                ->join('teachers', 'teachers.user_id', 'class_subjects.user_id')
                ->join('users', 'users.id', 'teachers.user_id')
                ->join('roles','roles.id','users.role_id')
                ->where('roles.name','Teacher')
                ->where('class_subjects.class_header_id', $classId)
                ->get()
        ]);
    }
    
}