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
    public function viewClassDetailsAdmin($id){
            return view('admin.class-student-list',[
                'classDetails' => ClassDetail::select('users.id as id', 'users.name as name', 'class_details.id as classDetailId','users.user_code as nisn','class_headers.name as className','class_headers.id as classId', 'school_years.semester as semester', 'school_years.year as year', 'school_years.id as schoolYearId')
                    ->join('users', 'users.id', 'class_details.student_user_id')
                    ->join('roles','roles.id','users.role_id')
                    ->join('class_headers','class_headers.id','class_details.class_header_id')
                    ->join('school_years','school_years.id','class_headers.school_year_id')
                    ->where('roles.name','Student')
                    ->where('class_details.class_header_id', $id)
                    ->get(),
                'students' => User::select('users.id as id', 'users.name as name', 'users.user_code as nisn', 'users.email as email')
                    ->join('roles','roles.id','users.role_id')
                    ->leftJoin('class_details', 'class_details.student_user_id', 'users.id')
                    ->where('roles.name','Student')
                    ->whereNull('class_details.student_user_id')
                ->get()
            ]);
    }

    public function viewClassDetails($id){
        return view('students.index',[
            'classDetails' => ClassDetail::select('users.id as studentId', 'users.name as studentName', 'users.user_code as nisn', 'class_details.id as classDetailId',
                            'class_subjects.id as id', 'class_subjects.name as name',
                            'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'userC.name as teacherName',
                            'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'userC.user_code as teacherNuptk')
                            ->join('users', 'users.id', 'class_details.student_user_id')
                            ->join('roles','roles.id','users.role_id')
                            ->join('class_subjects', 'class_subjects.class_header_id', 'class_details.class_header_id')
                            ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                            ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                            ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_user_id')
                            ->join('users as userC', 'userC.id', 'class_subjects.teacher_user_id')
                            ->where('roles.name','Student')
                            ->where('class_subjects.id', $id)
                            ->get()
        ]);
    }

    public function assignStudentToClass(Request $request){
        ClassDetail::create([
            'class_header_id' => $request->class_id,
            'student_user_id' => $request->student_id
        ]);

        return redirect()->back()->with('success','Success Assign Student to Class');
    }    

    public function removeStudentFromClass($id){
        ClassDetail::destroy($id);

        return redirect()->back()->with('success', 'Student Deleted');
    }

    public function viewChooseClass() {
        if (auth()->user()->role->name === 'Student') {
            return view('students.index', [
                'classSubjects' => ClassSubject::select('class_headers.id as classId','class_headers.name','school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as homeroomTeacherName', 'class_headers.homeroom_teacher_user_id as homeroomTeacherId', 'users.user_code as homeRoomTeacherNuptk',
                                    'class_subjects.id as subjectId', 'class_subjects.name as subjectName','user2.id as teacherId', 'user2.name as teacherName', 'user2.user_code as teacherNuptk')
                                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')    
                                    ->join('school_years','school_years.id','class_headers.school_year_id')
                                    ->join('class_details', 'class_details.class_header_id', 'class_headers.id')
                                    ->join('users', 'users.id', 'class_headers.homeroom_teacher_user_id')
                                    ->join('users as user2', 'user2.id', 'class_subjects.teacher_user_id')
                                    ->join('roles','roles.id','users.role_id')
                                    ->where('roles.name','Teacher')
                                    ->where('class_details.student_user_id', auth()->user()->user_id)
                                    ->orderBy('class_headers.school_year_id', 'DESC')->get()
            ]);
        } else {

            return view('students.index',[
                'classSubjects' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name', 'class_headers.name as className', 'class_headers.id as classId','users.id as teacherId', 'users.name as teacherName', 'users.user_code as teacherNuptk', 'userB.name as homeroomTeacherName', 'userB.user_code as homeroomTeacherNuptk', 'school_years.year as schoolYear', 'school_years.semester as semester', 'school_years.id as schoolYearId')
                                    ->join('users', 'users.id', 'class_subjects.teacher_user_id')
                                    ->join('roles','roles.id','users.role_id')
                                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                                    ->join('school_years','school_years.id','class_headers.school_year_id')
                                    ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_user_id')
                                    ->where('roles.name','Teacher')
                                    ->where('class_subjects.teacher_user_id', auth()->user()->user_id)
                                    ->orderBy('class_headers.school_year_id', 'DESC')->get()
            ]);
        }

    }
}
