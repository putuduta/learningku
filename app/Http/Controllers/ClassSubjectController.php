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
            'classSubjects' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name','user.user_id as teacherId', 'user.name as teacherName', 'user.user_code as teacherNuptk', 'class_subjects.minimum_score'
                ,'class_headers.name as className','class_headers.id as classId', 'school_year.semester as semester', 'school_year.year as year', 'school_year.school_year_id as schoolYearId')
                ->join('user', 'user.user_id', 'class_subjects.user_id')
                ->join('role','role.role_id','user.role_id')
                ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                ->join('school_year', 'school_year.school_year_id', 'class_headers.school_year_id')
                ->where('role.name','Teacher')
                ->where('class_subjects.class_header_id', $class->id)
                ->get(),
            'teachers' => User::select('user.user_id as id', 'user.name as name', 'user.user_code as nuptk')
                ->join('role','role.role_id','user.role_id')
                ->where('role.name','Teacher')
                ->whereNotIn('user.user_id', User::select('user.user_id as id')
                ->join('role','role.role_id','user.role_id')
                ->join('class_subjects', 'class_subjects.user_id', 'user.user_id')
                ->where('role.name','Teacher')
                ->where('class_subjects.class_header_id', $class->id)->get()->toArray())
            ->get()
        ]);
    }


    public function store($classId, Request $request){

        $this->validateData($request);
        
        ClassSubject::create([
            'name' => $request->name,
            'class_header_id' => $classId,
            'user_id' => $request->teacher_id,
            'minimum_score' => $request->minimum_score
        ]);

        return redirect()->back()->with('success','Success Add Subject to Class');
    }

    public function update(ClassSubject $classSubject, Request $request){

        $this->validateData($request);

        $classSubject->update([
            'name' => $request->name,
            'class_header_id' => $request->class_id,
            'user_id' => $request->teacher_id,
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

    public function viewClassAndSubject() {
        if (auth()->user()->role->name === 'Student') {
            return view('dashboard.class-subject', [
                'classSubjects' => ClassSubject::select('class_headers.id as classId','class_headers.name','school_year.year as schoolYear', 'school_year.semester as semester', 'user.name as homeroomTeacherName', 'class_headers.user_id as homeroomTeacherId', 'user.user_code as homeRoomTeacherNuptk',
                                    'class_subjects.id as subjectId', 'class_subjects.name as subjectName','user2.user_id as teacherId', 'user2.name as teacherName', 'user2.user_code as teacherNuptk')
                                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')    
                                    ->join('school_year','school_year.school_year_id','class_headers.school_year_id')
                                    ->join('class_details', 'class_details.class_header_id', 'class_headers.id')
                                    ->join('user', 'user.user_id', 'class_headers.user_id')
                                    ->join('user as user2', 'user2.user_id', 'class_subjects.user_id')
                                    ->join('role','role.id','user.role_id')
                                    ->where('role.name','Teacher')
                                    ->where('class_details.student_user_id', auth()->user()->user_id)
                                    ->orderBy('class_headers.school_year_id', 'DESC')->get(),
            ]);
        } else {

            return view('dashboard.class-subject',[
                'classSubjects' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name', 'class_headers.name as className', 'class_headers.id as classId','user.user_id as teacherId', 'user.name as teacherName', 'user.user_code as teacherNuptk', 'userB.name as homeroomTeacherName', 'userB.user_code as homeroomTeacherNuptk', 'school_year.year as schoolYear', 'school_year.semester as semester', 'school_year.school_year_id as schoolYearId')
                                    ->join('user', 'user.user_id', 'class_subjects.user_id')
                                    ->join('role','role.role_id','user.role_id')
                                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                                    ->join('school_year','school_year.school_year_id','class_headers.school_year_id')
                                    ->join('user as userB', 'userB.user_id', 'class_headers.user_id')
                                    ->where('role.name','Teacher')
                                    ->where('class_subjects.user_id', auth()->user()->user_id)
                                    ->orderBy('class_headers.school_year_id', 'DESC')->get()
            ]);
        }

    }

    public function getTeacherClassTaught($schoolYearId) {
        $classAndSubjects = ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name', 'class_headers.name as className', 'class_headers.id as classId','user.user_id as teacherId', 'user.name as teacherName', 'user.nuptk as teacherNuptk')
        ->join('user', 'user.user_id', 'class_subjects.user_id')
        ->join('role','role.role_id','user.role_id')
        ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
        ->where('role.name','Teacher')
        ->where('class_headers.school_year_id', $schoolYearId)
        ->where('class_subjects.user_id', auth()->user()->user_id)
        ->get();
        
        return $classAndSubjects;
    }

    public function getStudentClass($classId) {
        $classAndSubjects = ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name',
            'class_headers.name as className', 'school_year.year as schoolYear', 'school_year.semester as semester', 'user.name as teacherName',
            'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'user.user_code as teacherNuptk')
            ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
            ->join('school_year', 'school_year.school_year_id', 'class_headers.school_year_id')
            ->join('user', 'user.user_id', 'class_subjects.user_id')
            ->join('user as userB', 'userB.user_id', 'class_headers.user_id')
            ->where('class_headers.id', $classId)->get();
        
        return $classAndSubjects;
    }
}
