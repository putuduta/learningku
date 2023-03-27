<?php

namespace App\Http\Controllers;

use App\Models\ClassDetail;
use App\Models\ClassHeader;
use App\Models\ClassSubject;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ClassDetailController extends Controller
{
    public function viewClassDetails($id){
        if (auth()->user()->role->name == 'Admin') {
            $class = ClassHeader::where('id', $id)->first();

            return view('admin.class-student-list',[
                'students' => ClassDetail::select('users.id as id', 'users.name as name', 'class_details.id as classDetailId')
                    ->join('students', 'students.user_id', 'class_details.student_user_id')
                    ->join('users', 'users.id', 'students.user_id')
                    ->join('roles','roles.id','users.role_id')
                    ->where('roles.name','Student')
                    ->where('class_details.class_header_id', $class->id)
                    ->get(),
                'class' => $class,
                'studentsNotAssigned' => Student::select('users.id as id', 'users.name as name', 'students.nisn as nisn', 'users.email as email')
                    ->join('users', 'users.id', 'students.user_id')
                    ->join('roles','roles.id','users.role_id')
                    ->leftJoin('class_details', 'class_details.student_user_id', 'students.user_id')
                    ->where('roles.name','Student')
                    ->whereNull('class_details.student_user_id')
                ->get(),
                'schoolYear' => SchoolYear::where('id', $class->school_year_id)->first()
            ]);
        } else {
            return view('class.student-list',[
                'students' => ClassDetail::select('users.id as id', 'users.name as name', 'students.nisn as nisn', 'class_details.id as classDetailId')
                    ->join('students', 'students.user_id', 'class_details.student_user_id')
                    ->join('users', 'users.id', 'students.user_id')
                    ->join('roles','roles.id','users.role_id')
                    ->join('class_subjects', 'class_subjects.class_header_id', 'class_details.class_header_id')
                    ->where('roles.name','Student')
                    ->where('class_subjects.class_header_id', $id)
                    ->distinct()
                    ->get(),
                'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name','class_subjects.description as description',
                    'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName')
                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                    ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                    ->join('teachers', 'teachers.user_id', 'class_subjects.teacher_user_id')
                    ->join('users', 'users.id', 'teachers.user_id')
                    ->where('class_subjects.class_header_id', $id)->first(),
            ]);
        }
    }

    public function assignStudentToClass($classId, Request $request){
        ClassDetail::create([
            'class_header_id' => $classId,
            'user_id' => $request->student_id
        ]);

        return redirect()->back()->with('success','Success Assign Student to Class');
    }    

    public function removeStudentFromClass($id){
        $deleteClassDetail = ClassDetail::find($id);
        $deleteClassDetail->delete();

        return redirect()->back()->with('success', 'Student Deleted');
    }
}
