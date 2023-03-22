<?php

namespace App\Http\Controllers;

use App\Models\ClassDetail;
use App\Models\ClassHeader;
use App\Models\ClassSubject;
use App\Models\RequestClass;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClassController extends Controller
{
    public function viewListClass(){
        $lastSchoolYearId = SchoolYear::select('school_years.id as id')->orderBy('id', 'DESC')->first();

        // dd($lastSchoolYearId);

        return view('class.list',[
            'schoolYears' => SchoolYear::orderBy('id', 'DESC')->get(),
            'classAndSubjects' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name','class_subjects.description as description', 'class_headers.name as className', 'class_headers.id as classId','users.id as teacherId', 'users.name as teacherName')
            ->join('teachers', 'teachers.user_id', 'class_subjects.user_id')
            ->join('users', 'users.id', 'teachers.user_id')
            ->join('roles','roles.id','users.role_id')
            ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
            ->where('roles.name','Teacher')
            ->where('class_headers.school_year_id', $lastSchoolYearId->id)
            ->where('class_subjects.user_id', auth()->user()->id)
            ->get()
        ]);
    }

    public function getListClass($schoolYearId) {
        $classAndSubjects = ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name','class_subjects.description as description', 'class_headers.name as className', 'class_headers.id as classId','users.id as teacherId', 'users.name as teacherName')
        ->join('teachers', 'teachers.user_id', 'class_subjects.user_id')
        ->join('users', 'users.id', 'teachers.user_id')
        ->join('roles','roles.id','users.role_id')
        ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
        ->where('roles.name','Teacher')
        ->where('class_headers.school_year_id', $schoolYearId)
        ->where('class_subjects.user_id', auth()->user()->id)
        ->get();
        
        return $classAndSubjects;
    }

    public function viewCreateClass(){
        return view('class.create',[
            'teachers' => User::select('users.id','users.name')
                        ->where('users.role','Teacher')
                        ->get()
        ]);
    }

    public function createClass(Request $request){

        $request->validate([
            'class_name' => 'required|string',
            'class_description' => 'required|string'
        ]);

        ClassHeader::create([
            'guid' => bin2hex(random_bytes('16')),
            'name' => $request->class_name,
            'description' => $request->class_description,
            'teacher_id' => auth()->user()->id
        ]);

        return redirect()->route('class-view-list')->with('success','New Class Created');
    }

    public function viewClassStudent($classSubjectId){
        return view('class.student-list',[
            'students' => ClassDetail::select('users.id as id', 'users.name as name', 'students.nisn as nisn', 'class_details.id as classDetailId')
                ->join('students', 'students.user_id', 'class_details.user_id')
                ->join('users', 'users.id', 'students.user_id')
                ->join('roles','roles.id','users.role_id')
                ->join('class_subjects', 'class_subjects.class_header_id', 'class_details.class_header_id')
                ->where('roles.name','Student')
                ->where('class_subjects.class_header_id', $classSubjectId)
                ->get(),
            'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name','class_subjects.description as description',
                'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName')
                ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                ->join('teachers', 'teachers.user_id', 'class_subjects.user_id')
                ->join('users', 'users.id', 'teachers.user_id')
                ->where('class_subjects.class_header_id', $classSubjectId)->first(),
        ]);
    }

    public function viewJoinClass($guid){
        return view('request-class.index',[
            'classes' => ClassHeader::where('guid', $guid)->first()
        ]);
    }
   
    public function requestClass(Request $request){
        
        RequestClass::create([
            'student_id' => auth()->user()->id,
            'class_id' => $request->class_id,
            'status' => 'New Request',
            'comment' => $request->comment
        ]);

        return redirect()->route('home')->with('success','Request Join Class');
    }

    public function listRequestClass(){
        
        if (auth()->user()->role == 'Teacher') {
            return view('request-class.list',[
                'requestClasses' => RequestClass::select('request_classes.id','request_classes.status','request_classes.comment', 'users.id as studentId', 'users.name as studentName', 'users.role', 'class_headers.id as classId', 'class_headers.name as className')
                ->join('class_headers','class_headers.id','request_classes.class_id')
                ->join('users','users.id','request_classes.student_id')
                ->where('class_headers.teacher_id',auth()->user()->id)
                ->get()
            ]);
        }else if (auth()->user()->role == 'Student') {
            return view('request-class.list',[
                'requestClasses' => RequestClass::select('request_classes.id','request_classes.status','request_classes.comment', 'users.id as teacherId', 'users.name as teacherName', 'users.role', 'class_headers.id as classId', 'class_headers.name as className')
                ->join('class_headers','class_headers.id','request_classes.class_id')
                ->join('users','users.id','class_headers.teacher_id')
                ->where('request_classes.student_id',auth()->user()->id)
                ->get()
            ]);
        } else 
             return redirect()->route('home');
    }

    public function requestClassAction($classRequestId, $action){
        
        $requestClass = RequestClass::where('id', $classRequestId)->first();
        $message = '';

        if ($action == 'Approved')  {
            ClassDetail::create([
                'class_header_id' => $requestClass->class_id,
                'student_id' => $requestClass->student_id
            ]);
            $message = 'Approve Request Class';
        } else {
            $message = 'Reject Request Class';
        }

        $requestClass->update([
            'status' => $action
        ]);

        return redirect()->route('home')->with('success', $message);
    }

}
