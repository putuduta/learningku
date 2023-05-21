<?php

namespace App\Http\Controllers;

use App\Models\ClassHeader;
use App\Models\ClassSubject;
use Illuminate\Http\Request;
use App\Models\User;

class ClassSubjectController extends Controller
{
    public function index(ClassHeader $class){
        return view('admin.class-subject-list',[
            'classSubjects' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name','users.id as teacherId', 'users.name as teacherName', 'users.user_code as teacherNuptk', 'class_subjects.minimum_score'
                ,'class_headers.name as className','class_headers.id as classId', 'school_years.semester as semester', 'school_years.year as year', 'school_years.id as schoolYearId')
                ->join('users', 'users.id', 'class_subjects.teacher_user_id')
                ->join('roles','roles.id','users.role_id')
                ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                ->where('roles.name','Teacher')
                ->where('class_subjects.class_header_id', $class->id)
                ->get(),
            'teachers' => User::select('users.id as id', 'users.name as name', 'users.user_code as nuptk')
                ->join('roles','roles.id','users.role_id')
                ->where('roles.name','Teacher')
                ->whereNotIn('users.id', User::select('users.id as id')
                ->join('roles','roles.id','users.role_id')
                ->join('class_subjects', 'class_subjects.teacher_user_id', 'users.id')
                ->where('roles.name','Teacher')
                ->where('class_subjects.class_header_id', $class->id)->get()->toArray())
            ->get()
        ]);
    }


    public function store($classId, Request $request){

        $this->validateData($request);
        
        ClassSubject::create([
            'name' => $request->name,
            'class_header_id' => $classId,
            'teacher_user_id' => $request->teacher_id,
            'minimum_score' => $request->minimum_score
        ]);

        return redirect()->back()->with('success','Success Add Subject to Class');
    }

    public function update(ClassSubject $classSubject, Request $request){

        $this->validateData($request);

        $classSubject->update([
            'name' => $request->name,
            'class_header_id' => $request->class_id,
            'teacher_user_id' => $request->teacher_id,
            'minimum_score' => $request->minimum_score
        ]);

        return redirect()->back()->with('success', 'Subject Updated');
    }

    public function destroy($id){
        ClassSubject::destroy($id);

        return redirect()->back()->with('success', 'Subject Deleted');
    }

    public function validateData($request) {
        $request->validate([
            'name' => 'required|string',
            'minimum_score' => 'required|integer'
        ]);

    }

    public function viewClassAndSubjectStudent() {
        return view('dashboard.class-subject', [
            'classSubjects' => ClassSubject::select('class_headers.id as classId','class_headers.name','school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as homeroomTeacherName', 'class_headers.homeroom_teacher_user_id as homeroomTeacherId', 'users.user_code as homeRoomTeacherNuptk',
                                'class_subjects.id as subjectId', 'class_subjects.name as subjectName','user2.id as teacherId', 'user2.name as teacherName', 'user2.user_code as teacherNuptk')
                                ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')    
                                ->join('school_years','school_years.id','class_headers.school_year_id')
                                ->join('class_details', 'class_details.class_header_id', 'class_headers.id')
                                ->join('users', 'users.id', 'class_headers.homeroom_teacher_user_id')
                                ->join('users as user2', 'user2.id', 'class_subjects.teacher_user_id')
                                ->join('roles','roles.id','users.role_id')
                                ->where('roles.name','Teacher')
                                ->where('class_details.student_user_id', auth()->user()->id)
                                ->orderBy('class_headers.school_year_id', 'DESC')->get(),
        ]);
    }

    public function viewClassAndSubjectTeacher() {
        return view('dashboard.class-subject',[
            'classSubjects' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name', 'class_headers.name as className', 'class_headers.id as classId','users.id as teacherId', 'users.name as teacherName', 'users.user_code as teacherNuptk', 'userB.name as homeroomTeacherName', 'userB.user_code as homeroomTeacherNuptk', 'school_years.year as schoolYear', 'school_years.semester as semester', 'school_years.id as schoolYearId')
                                ->join('users', 'users.id', 'class_subjects.teacher_user_id')
                                ->join('roles','roles.id','users.role_id')
                                ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                                ->join('school_years','school_years.id','class_headers.school_year_id')
                                ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_user_id')
                                ->where('roles.name','Teacher')
                                ->where('class_subjects.teacher_user_id', auth()->user()->id)
                                ->orderBy('class_headers.school_year_id', 'DESC')->get(),
        ]);
    }

    public function getTeacherClassTaught($schoolYearId) {
        $classAndSubjects = ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name', 'class_headers.name as className', 'class_headers.id as classId','users.id as teacherId', 'users.name as teacherName', 'users.nuptk as teacherNuptk')
        ->join('users', 'users.id', 'class_subjects.teacher_user_id')
        ->join('roles','roles.id','users.role_id')
        ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
        ->where('roles.name','Teacher')
        ->where('class_headers.school_year_id', $schoolYearId)
        ->where('class_subjects.teacher_user_id', auth()->user()->id)
        ->get();
        
        return $classAndSubjects;
    }

    public function getStudentClass($classId) {
        $classAndSubjects = ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name',
            'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName',
            'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'users.user_code as teacherNuptk')
            ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
            ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
            ->join('users', 'users.id', 'class_subjects.teacher_user_id')
            ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_user_id')
            ->where('class_headers.id', $classId)->get();
        
        return $classAndSubjects;
    }
}
