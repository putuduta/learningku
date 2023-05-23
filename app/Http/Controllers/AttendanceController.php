<?php

namespace App\Http\Controllers;

use App\Models\AttendanceDetail;
use App\Models\AttendanceHeader;
use App\Models\ClassDetail;
use App\Models\ClassSubject;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function viewAttendanceTeacher($classSubjectId)
    {
        return view('attendance.index', [
            'attendances' => AttendanceHeader::select(
                    'attendance_headers.id',
                    'attendance_headers.class_subject_id',
                    'attendance_headers.date',
                    'class_subjects.name as subjectName',
                    'class_headers.name as className')
                ->join('class_subjects', 'attendance_headers.class_subject_id', 'class_subjects.id')
                ->join('class_headers', 'class_subjects.class_header_id', 'class_headers.id')
                ->where('class_subjects.teacher_user_id', auth()->user()->id)->get(),
            'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name',
                'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName',
                'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'users.user_code as teacherNuptk')
                ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                ->join('users', 'users.id', 'class_subjects.teacher_user_id')
                ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_user_id')
                ->find($classSubjectId)
        ]);
    }

    public function viewAttendanceStudent($classSubjectId)
    {
        return view('attendance.index', [
            'attendances' => AttendanceDetail::where('student_user_id', auth()->user()->id)->get(),
            'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name',
                'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName',
                'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'users.user_code as teacherNuptk')
                ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                ->join('users', 'users.id', 'class_subjects.teacher_user_id')
                ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_user_id')
                ->find($classSubjectId),
        ]);      
    }

    public function viewCreate($classSubjectId)
    {
        return view('attendance.create', [
            'classDetails' => ClassDetail::select('users.id as studentId', 'users.name as studentName', 'users.user_code as studentNisn', 'class_details.id as classDetailId',
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
                ->where('class_subjects.id', $classSubjectId)
                ->get()               
        ]);
        
    }

    public function create(Request $request)
    {
        $this->validateData($request);

        $lastAttendance = AttendanceHeader::create([
            'class_subject_id' => $request->class_subject_id,
            'date' => date('y-m-d'),
        ]);

        $classDetails = ClassDetail::select('users.id as studentId', 'users.name as studentName', 'class_details.id as classDetailId')
                    ->join('users', 'users.id', 'class_details.student_user_id')
                    ->join('roles','roles.id','users.role_id')
                    ->join('class_subjects', 'class_subjects.class_header_id', 'class_details.class_header_id')
                    ->where('roles.name','Student')
                    ->where('class_subjects.id', $request->class_subject_id)
                    ->get();

        foreach ($classDetails as $student) {
            AttendanceDetail::create([
                'attendance_header_id' => $lastAttendance->id,
                'student_user_id' => $student->studentId,
                'status' => request('present-'.$student->studentId) ? 'Present' : (request('sick-'.$student->studentId) ? 'Sick' : (request('absencePermit-'.$student->studentId) ? 'Absence Permit' : (request('absent-'.$student->studentId) ? 'Absent' : '')))
            ]);
        }

        return redirect()->route('attendance.view-teacher', $request->class_subject_id)->with('success', 'New Attendance created');
    }

    public function validateData($request) {
        $request->validate([
            'class_subject_id' => 'required'
        ]);
    }


    public function viewChooseClassSubject() {
        if (auth()->user()->role->name === 'Student') {
            return view('attendance.index', [
                'classSubjects' => ClassSubject::select('class_headers.id as classId','class_headers.name','school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as homeroomTeacherName', 'class_headers.homeroom_teacher_user_id as homeroomTeacherId', 'users.user_code as teacherNuptk',
                                    'class_subjects.id as subjectId', 'class_subjects.name as subjectName','user2.id as teacherId', 'user2.name as teacherName', 'user2.user_code as teacherNuptk')
                                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')    
                                    ->join('school_years','school_years.id','class_headers.school_year_id')
                                    ->join('class_details', 'class_details.class_header_id', 'class_headers.id')
                                    ->join('users', 'users.id', 'class_headers.homeroom_teacher_user_id')
                                    ->join('users as user2', 'user2.id', 'class_subjects.teacher_user_id')
                                    ->join('roles','roles.id','users.role_id')
                                    ->where('roles.name','Teacher')
                                    ->where('class_details.student_user_id', auth()->user()->id)
                                    ->orderBy('class_headers.school_year_id', 'DESC')->get()
            ]);
        } else {

            return view('attendance.index',[
                'classSubjects' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name', 'class_headers.name as className', 'class_headers.id as classId','users.id as teacherId', 'users.name as teacherName', 'users.user_code as teacherNuptk', 'userB.name as homeroomTeacherName', 'userB.user_code as homeroomTeacherNuptk', 'school_years.year as schoolYear', 'school_years.semester as semester', 'school_years.id as schoolYearId')
                                    ->join('users', 'users.id', 'class_subjects.teacher_user_id')
                                    ->join('roles','roles.id','users.role_id')
                                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                                    ->join('school_years','school_years.id','class_headers.school_year_id')
                                    ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_user_id')
                                    ->where('roles.name','Teacher')
                                    ->where('class_subjects.teacher_user_id', auth()->user()->id)
                                    ->orderBy('class_headers.school_year_id', 'DESC')->get()
            ]);
        }
    }
}

