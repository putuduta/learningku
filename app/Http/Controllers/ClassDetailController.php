<?php

namespace App\Http\Controllers;

use App\Models\ClassDetail;
use App\Models\ClassSubject;
use Illuminate\Http\Request;
use App\Models\User;

class ClassDetailController extends Controller
{
    public function viewClassDetailsAdmin($id){
            return view('admin.class-student-list',[
                'classDetails' => ClassDetail::select('user.user_id as id', 'user.name as name', 'class_details.id as classDetailId','user.user_code as nisn','class_header.name as className','class_header.class_header_id as classId', 'school_year.semester as semester', 'school_year.year as year', 'school_year.school_year_id as schoolYearId')
                    ->join('user', 'user.user_id', 'class_details.user_id')
                    ->join('role','role.role_id','user.role_id')
                    ->join('class_header','class_header.class_header_id','class_details.class_header_id')
                    ->join('school_year','school_year.school_year_id','class_header.school_year_id')
                    ->where('role.name','Student')
                    ->where('class_details.class_header_id', $id)
                    ->get(),
                'students' => User::select('user.user_id as id', 'user.name as name', 'user.user_code as nisn', 'user.email as email')
                    ->join('role','role.role_id','user.role_id')
                    ->leftJoin('class_details', 'class_details.user_id', 'user.user_id')
                    ->where('role.name','Student')
                    ->whereNull('class_details.user_id')
                ->get()
            ]);
    }

    public function viewClassDetails($id){
        return view('students.index',[
            'classDetails' => ClassDetail::select('user.user_id as studentId', 'user.name as studentName', 'user.user_code as nisn', 'class_details.id as classDetailId',
                            'class_subject.class_subject_id as id', 'class_subject.name as name',
                            'class_header.name as className', 'school_year.year as schoolYear', 'school_year.semester as semester', 'userC.name as teacherName',
                            'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'userC.user_code as teacherNuptk')
                            ->join('user', 'user.user_id', 'class_details.user_id')
                            ->join('role','role.role_id','user.role_id')
                            ->join('class_subject', 'class_subject.class_header_id', 'class_details.class_header_id')
                            ->join('class_header', 'class_header.class_header_id', 'class_subject.class_header_id')
                            ->join('school_year', 'school_year.school_year_id', 'class_header.school_year_id')
                            ->join('user as userB', 'userB.user_id', 'class_header.user_id')
                            ->join('user as userC', 'userC.user_id', 'class_subject.user_id')
                            ->where('role.name','Student')
                            ->where('class_subject.class_subject_id', $id)
                            ->get()
        ]);
    }

    public function assignStudentToClass(Request $request){
        ClassDetail::create([
            'class_header_id' => $request->class_id,
            'user_id' => $request->student_id
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
                'classSubjects' => ClassSubject::select('class_header.class_header_id as classId','class_header.name','school_year.year as schoolYear', 'school_year.semester as semester', 'user.name as homeroomTeacherName', 'class_header.user_id as homeroomTeacherId', 'user.user_code as homeRoomTeacherNuptk',
                                    'class_subject.class_subject_id as subjectId', 'class_subject.name as subjectName','user2.id as teacherId', 'user2.name as teacherName', 'user2.user_code as teacherNuptk')
                                    ->join('class_header', 'class_header.class_header_id', 'class_subject.class_header_id')    
                                    ->join('school_year','school_year.school_year_id','class_header.school_year_id')
                                    ->join('class_details', 'class_details.class_header_id', 'class_header.class_header_id')
                                    ->join('user', 'user.user_id', 'class_header.user_id')
                                    ->join('user as user2', 'user2.id', 'class_subject.user_id')
                                    ->join('role','role.role_id','user.role_id')
                                    ->where('role.name','Teacher')
                                    ->where('class_details.user_id', auth()->user()->user_id)
                                    ->orderBy('class_header.school_year_id', 'DESC')->get()
            ]);
        } else {

            return view('students.index',[
                'classSubjects' => ClassSubject::select('class_subject.class_subject_id as id', 'class_subject.name as name', 'class_header.name as className', 'class_header.class_header_id as classId','user.user_id as teacherId', 'user.name as teacherName', 'user.user_code as teacherNuptk', 'userB.name as homeroomTeacherName', 'userB.user_code as homeroomTeacherNuptk', 'school_year.year as schoolYear', 'school_year.semester as semester', 'school_year.school_year_id as schoolYearId')
                                    ->join('user', 'user.user_id', 'class_subject.user_id')
                                    ->join('role','role.role_id','user.role_id')
                                    ->join('class_header', 'class_header.class_header_id', 'class_subject.class_header_id')
                                    ->join('school_year','school_year.school_year_id','class_header.school_year_id')
                                    ->join('user as userB', 'userB.user_id', 'class_header.user_id')
                                    ->where('role.name','Teacher')
                                    ->where('class_subject.user_id', auth()->user()->user_id)
                                    ->orderBy('class_header.school_year_id', 'DESC')->get()
            ]);
        }

    }
}
