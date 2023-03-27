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

class ClassHeaderController extends Controller
{

    public function viewChooseSchoolYear(){
        return view('admin.choose-school-year',[
            'schoolYears' => SchoolYear::get()
        ]);
    }

    // Class
    public function postChooseSchoolYear(Request $request){
        return redirect()->route('admin-class-view', $request->school_year_id);
    }

    public function viewAdminClassList($schoolYearId){
        return view('admin.class-list',[
            'classes' => ClassHeader::select('class_headers.id','class_headers.name','school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as homeroomTeacherName', 'class_headers.homeroom_teacher_id as homeroomTeacherId')
                ->join('school_years','school_years.id','class_headers.school_year_id')
                ->join('teachers', 'teachers.user_id', 'class_headers.homeroom_teacher_id')
                ->join('users', 'users.id', 'teachers.user_id')
                ->where('class_headers.school_year_id', $schoolYearId)
                ->get(),
            'teachers' => Teacher::select('users.id as id', 'users.name as name')
                ->join('users', 'users.id', 'teachers.user_id')
                ->join('roles','roles.id','users.role_id')
                ->where('roles.name','Teacher')
                ->get(),
            'teachersNotAssigned' => Teacher::select('users.id as id', 'users.name as name')
                ->join('users', 'users.id', 'teachers.user_id')
                ->join('roles','roles.id','users.role_id')
                ->leftJoin('class_headers', 'class_headers.homeroom_teacher_id', 'teachers.user_id')
                ->where('roles.name','Teacher')
                ->whereNull('class_headers.homeroom_teacher_id')
                ->get(),
            'schoolYear' => SchoolYear::where('id', $schoolYearId)->first()
        ]);
    }

    public function store($schoolYearId, Request $request){

        $request->validate([
            'class_name' => 'required|string'
        ]);

        ClassHeader::create([
            'name' => $request->class_name,
            'school_year_id' => $schoolYearId,
            'homeroom_teacher_id' => $request->homeroom_teacher_id,
        ]);

        return redirect()->back()->with('success','New Class Created');
    }

    public function update($id, Request $request){
        $class = ClassHeader::find($id);

        $class->name = $request->class_name;
        $class->school_year_id = $request->school_year_id;
        $class->homeroom_teacher_id = $request->homeroom_teacher_id;
        
        $class->save();

        return redirect()->back()->with('success', 'Class Updated');
    }    

    public function destroy($id)
    {
        $schoolYear = ClassHeader::find($id);
        $schoolYear->delete();

        return redirect()->back()->with('success', 'Class deleted');
    }

    public function viewClassStudentDashboard($classId) {
        return view('dashboard.class-student', [
            'class' => ClassHeader::select('class_headers.id','class_headers.name','school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as homeroomTeacherName', 'class_headers.homeroom_teacher_id as homeroomTeacherId')
                ->join('school_years','school_years.id','class_headers.school_year_id')
                ->join('teachers', 'teachers.user_id', 'class_headers.homeroom_teacher_id')
                ->join('users', 'users.id', 'teachers.user_id')
                ->where('class_headers.id', $classId)
                ->first(),
            'subjects' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name','class_subjects.description as description','users.id as teacherId', 'users.name as teacherName')
                ->join('teachers', 'teachers.user_id', 'class_subjects.teacher_user_id')
                ->join('users', 'users.id', 'teachers.user_id')
                ->join('roles','roles.id','users.role_id')
                ->where('roles.name','Teacher')
                ->where('class_subjects.class_header_id', $classId)
                ->get()
        ]);
    }

    public function viewClassTeacherDashboard(){
        $lastSchoolYearId = SchoolYear::select('school_years.id as id')->orderBy('id', 'DESC')->first();

        // dd($lastSchoolYearId);

        return view('dashboard.class-teacher',[
            'schoolYears' => SchoolYear::orderBy('id', 'DESC')->get(),
            'classAndSubjects' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name','class_subjects.description as description', 'class_headers.name as className', 'class_headers.id as classId','users.id as teacherId', 'users.name as teacherName')
            ->join('teachers', 'teachers.user_id', 'class_subjects.teacher_user_id')
            ->join('users', 'users.id', 'teachers.user_id')
            ->join('roles','roles.id','users.role_id')
            ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
            ->where('roles.name','Teacher')
            ->where('class_headers.school_year_id', $lastSchoolYearId->id)
            ->where('class_subjects.teacher_user_id', auth()->user()->id)
            ->get()
        ]);
    }

    public function getTeacherClassTaught($schoolYearId) {
        $classAndSubjects = ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name','class_subjects.description as description', 'class_headers.name as className', 'class_headers.id as classId','users.id as teacherId', 'users.name as teacherName')
        ->join('teachers', 'teachers.user_id', 'class_subjects.teacher_user_id')
        ->join('users', 'users.id', 'teachers.user_id')
        ->join('roles','roles.id','users.role_id')
        ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
        ->where('roles.name','Teacher')
        ->where('class_headers.school_year_id', $schoolYearId)
        ->where('class_subjects.teacher_user_id', auth()->user()->id)
        ->get();
        
        return $classAndSubjects;
    }
}