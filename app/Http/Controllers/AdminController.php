<?php

namespace App\Http\Controllers;

use App\Models\ClassDetail;
use App\Models\ClassHeader;
use App\Models\SchoolYear;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // public function viewListClass(){
    //     return view('admin.class-list',[
    //         'classes' => ClassDetail::where('institution_id', auth()->user()->institution_id)->get(),
    //     ]);
    // }

    // School Year
    public function viewSchoolYear(){
        return view('admin.school-year',[
            'schoolYears' => SchoolYear::get()
        ]);
    }

    public function createSchoolYear(Request $request){

        $request->validate([
            'year' => 'required|string',
            'semester' => 'required|string'
        ]);

        SchoolYear::create([
            'year' => $request->year,
            'semester' => $request->semester,
        ]);

        return redirect()->route('school-year-view')->with('success','New School Year Created');
    }

    public function updateSchoolYear($id, Request $request){
        $schoolYear = SchoolYear::find($id);

        $schoolYear->year = $request->year;
        $schoolYear->semester = $request->semester;
        
        $schoolYear->save();

        return redirect()->back()->with('success', 'School Year Updated');
    }

    public function viewChooseSchoolYear(){
        return view('admin.choose-school-year',[
            'schoolYears' => SchoolYear::get()
        ]);
    }

    // Class
    public function postChooseSchoolYear(Request $request){
        return $this->viewClassList($request->school_year_id);
    }

    public function viewClassList($schoolYearId){
        return view('admin.class-list',[
            'classes' => ClassHeader::select('class_headers.id','class_headers.name','school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as homeroomTeacherName', 'class_headers.homeroom_teacher_id as homeroom_teacher_id')
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
            'schoolYear' => SchoolYear::where('id', $schoolYearId)->first()
        ]);
    }

    public function createClass($schoolYearId, Request $request){

        $request->validate([
            'class_name' => 'required|string'
        ]);

        ClassHeader::create([
            'name' => $request->class_name,
            'school_year_id' => $schoolYearId,
            'homeroom_teacher_id' => $request->homeroom_teacher_id,
        ]);

        return redirect()->route('admin-class-view')->with('success','New Class Created');
    }

    public function updateClass($id, Request $request){
        $class = ClassHeader::find($id);

        $class->name = $request->name;
        $class->school_year_id = $request->school_year_id;
        $class->homeroom_teacher_id = $request->homeroom_teacher_id;
        
        $class->save();

        return redirect()->back()->with('success', 'Class Updated');
    }

    public function viewClassStudent(ClassDetail $class){
        return view('admin.class-student-list',[
            'students' => User::select('users.id','users.name')
                        ->join('roles','roles.id','users.role_id')
                        ->where([['roles.name','Student'],['class_id',$class->id]])
                        ->get(),
            'class' => $class,
        ]);
    }

    public function viewListStudent(){
        return view('admin.student-list',[
            'students' => User::select('users.id','users.name')
                        ->join('roles','roles.id','users.role_id')
                        ->where([['roles.name','Student'],['institution_id',auth()->user()->institution_id]])
                        ->get()
        ]);
    }

    public function viewCreateStudent(){
        return view('admin.student-create',[
            'classes' => ClassDetail::where('institution_id',auth()->user()->institution_id)->get()
        ]);
    }

    public function createStudent(Request $request){
        
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'reg_number' => 'required|numeric',
            'phone_number' => 'required|numeric',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'reg_number' => $request->reg_number,
            'phone_number' => $request->phone_number,
            'role_id' => 3,
            'institution_id' => auth()->user()->institution->id,
            'class_id' => $request->class_id,
            'password' => Hash::make('abcd')
        ]);

        return redirect()->route('student-view-list')->with('success','New Student Created');
    }

    public function viewListTeacher(){
        return view('admin.teacher-list',[
            'teachers' => User::select('users.id','users.name')
                        ->join('roles','roles.id','users.role_id')
                        ->where([['roles.name','Teacher'],['institution_id',auth()->user()->institution_id]])
                        ->get()
        ]);
    }

    public function viewCreateTeacher(){
        return view('admin.teacher-create');
    }

    public function createTeacher(Request $request){
        
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'reg_number' => 'required|numeric',
            'phone_number' => 'required|numeric',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'reg_number' => $request->reg_number,
            'phone_number' => $request->phone_number,
            'role_id' => 2,
            'institution_id' => auth()->user()->institution->id,
            'password' => Hash::make('abcd')
        ]);

        return redirect()->route('teacher-view-list')->with('success','New Teacher Created');
    }

    
}
