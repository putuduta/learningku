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

        return redirect()->route('admin-school-year-view')->with('success','New School Year Created');
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
        return redirect()->route('admin-class-view', $request->school_year_id);
    }

    public function viewClassList($schoolYearId){
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

    public function createClass($schoolYearId, Request $request){

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

    public function updateClass($id, Request $request){
        $class = ClassHeader::find($id);

        $class->name = $request->class_name;
        $class->school_year_id = $request->school_year_id;
        $class->homeroom_teacher_id = $request->homeroom_teacher_id;
        
        $class->save();

        return redirect()->back()->with('success', 'Class Updated');
    }

    public function viewClassStudent(ClassHeader $class){
        return view('admin.class-student-list',[
            'students' => ClassDetail::select('users.id as id', 'users.name as name', 'class_details.id as classDetailId')
                ->join('students', 'students.user_id', 'class_details.user_id')
                ->join('users', 'users.id', 'students.user_id')
                ->join('roles','roles.id','users.role_id')
                ->where('roles.name','Student')
                ->where('class_details.class_header_id', $class->id)
                ->get(),
            'class' => $class,
            'studentsNotAssigned' => Student::select('users.id as id', 'users.name as name', 'students.nisn as nisn')
                ->join('users', 'users.id', 'students.user_id')
                ->join('roles','roles.id','users.role_id')
                ->leftJoin('class_details', 'class_details.user_id', 'students.user_id')
                ->where('roles.name','Student')
                ->whereNull('class_details.user_id')
            ->get(),
            'schoolYear' => SchoolYear::where('id', $class->school_year_id)->first()
        ]);
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

    public function viewClassSubject(ClassHeader $class){

        $teacherInClass = Teacher::select('users.id as id')
            ->join('users', 'users.id', 'teachers.user_id')
            ->join('roles','roles.id','users.role_id')
            ->join('class_subjects', 'class_subjects.user_id', 'teachers.user_id')
            ->where('roles.name','Teacher')
            ->where('class_subjects.class_header_id', $class->id)->get()->toArray();

        return view('admin.class-subject-list',[
            'classSubjects' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name','class_subjects.description as description','users.id as teacherId', 'users.name as teacherName')
                ->join('teachers', 'teachers.user_id', 'class_subjects.user_id')
                ->join('users', 'users.id', 'teachers.user_id')
                ->join('roles','roles.id','users.role_id')
                ->where('roles.name','Teacher')
                ->where('class_subjects.class_header_id', $class->id)
                ->get(),
            'class' => $class,
            'teachersNotAssigned' => Teacher::select('users.id as id', 'users.name as name', 'teachers.nuptk as nuptk')
                ->join('users', 'users.id', 'teachers.user_id')
                ->join('roles','roles.id','users.role_id')
                ->where('roles.name','Teacher')
                ->whereNotIn('users.id', $teacherInClass)
            ->get(),
            'schoolYear' => SchoolYear::where('id', $class->school_year_id)->first()
        ]);
    }


    public function assignSubjectToClass($classId, Request $request){

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        ClassSubject::create([
            'name' => $request->name,
            'description' => $request->description,
            'class_header_id' => $classId,
            'user_id' => $request->teacher_id
        ]);

        return redirect()->back()->with('success','Success Assign Subject to Class');
    }

    public function updateSubject($id, Request $request){

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        $subject = ClassSubject::find($id);

        $subject->name = $request->name;
        $subject->description = $request->description;
        $subject->class_header_id = $request->class_header_id;
        $subject->teacher_id = $request->teacher_id;
        
        $subject->save();

        return redirect()->back()->with('success', 'Subject Updated');
    }

    public function removeSubject($id){
        $deleteSubject = ClassSubject::find($id);
        $deleteSubject->delete();

        return redirect()->back()->with('success', 'Subject Deleted');
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
        /*return view('admin.teacher-list',[
            'teachers' => User::select('users.id','users.name')
                        ->join('roles','roles.id','users.role_id')
                        ->where([['roles.name','Teacher'],['institution_id',auth()->user()->institution_id]])
                        ->get()
        ]);*/

        return view('admin.teacher-list',[
            'teachers' => User::select('users.id','users.name')
                        ->join('roles','roles.id','users.role_id')
                        ->where([['roles.name','Teacher']])
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
