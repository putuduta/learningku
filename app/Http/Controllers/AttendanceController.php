<?php

namespace App\Http\Controllers;

use App\Models\AttendanceDetail;
use App\Models\AttendanceHeader;
use App\Models\ClassDetail;
use App\Models\ClassHeader;
use App\Models\ClassSubject;
use Illuminate\Http\Request;
use App\Models\User;

class AttendanceController extends Controller
{
    public function viewAttendance($classSubjectId)
    {
        if (auth()->user()->role->name == 'Teacher') {
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
                    'userB.name as homeRoomTeacherName', 'teacherB.nuptk as homeRoomTeacherNuptk', 'teachers.nuptk as teacherNuptk')
                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                    ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                    ->join('teachers', 'teachers.user_id', 'class_subjects.teacher_user_id')
                    ->join('users', 'users.id', 'teachers.user_id')
                    ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_id')
                    ->join('teachers as teacherB', 'teacherB.user_id', 'class_headers.homeroom_teacher_id')
                    ->where('class_subjects.id', $classSubjectId)->first(),
                'students' => ClassDetail::select('users.id as studentId', 'users.name as studentName', 'students.nisn as studentNisn', 'class_details.id as classDetailId')
                    ->join('students', 'students.user_id', 'class_details.student_user_id')
                    ->join('users', 'users.id', 'students.user_id')
                    ->join('roles','roles.id','users.role_id')
                    ->join('class_subjects', 'class_subjects.class_header_id', 'class_details.class_header_id')
                    ->where('roles.name','Student')
                    ->where('class_subjects.id', $classSubjectId)
                    ->get()
            ]);
        } else {
            return view('attendance.index', [
                'attendances' => AttendanceDetail::where('student_user_id', auth()->user()->id)->get(),
                'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name',
                    'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName',
                    'userB.name as homeRoomTeacherName', 'teacherB.nuptk as homeRoomTeacherNuptk', 'teachers.nuptk as teacherNuptk')
                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                    ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                    ->join('teachers', 'teachers.user_id', 'class_subjects.teacher_user_id')
                    ->join('users', 'users.id', 'teachers.user_id')
                    ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_id')
                    ->join('teachers as teacherB', 'teacherB.user_id', 'class_headers.homeroom_teacher_id')
                    ->where('class_subjects.id', $classSubjectId)->first()
            ]);           
        }
    }

    public function viewCreate($classSubjectId)
    {

        if (AttendanceHeader::where([['class_subject_id', $classSubjectId], ['date', date('y-m-d')]])->first() != NULL) {
            return redirect()->back()->with('error', 'You have submitted your attendance for your class today');
        } else {
            return view('attendance.create', [
                'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name','users.id as teacherId', 'users.name as teacherName'
                , 'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester')
                ->join('teachers', 'teachers.user_id', 'class_subjects.teacher_user_id')
                ->join('users', 'users.id', 'teachers.user_id')
                ->join('roles','roles.id','users.role_id')
                ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                ->where('roles.name','Teacher')
                ->where('class_subjects.id', $classSubjectId)->first(),
                'class_details' => ClassDetail::select('users.id as studentId', 'users.name as studentName', 'class_details.id as classDetailId', 'students.nisn as studentNisn')
                    ->join('students', 'students.user_id', 'class_details.student_user_id')
                    ->join('users', 'users.id', 'students.user_id')
                    ->join('roles','roles.id','users.role_id')
                    ->join('class_subjects', 'class_subjects.class_header_id', 'class_details.class_header_id')
                    ->where('roles.name','Student')
                    ->where('class_subjects.id', $classSubjectId)
                    ->get(),
            ]);
        }
    }

    public function create()
    {

        AttendanceHeader::create([
            'class_subject_id' => request('class_subject_id'),
            'date' => date('y-m-d'),
        ]);

        $last_attendance = AttendanceHeader::where('class_subject_id', request('class_subject_id'))->latest('created_at')->first();

        $students = ClassDetail::select('users.id as studentId', 'users.name as studentName', 'class_details.id as classDetailId')
                    ->join('students', 'students.user_id', 'class_details.student_user_id')
                    ->join('users', 'users.id', 'students.user_id')
                    ->join('roles','roles.id','users.role_id')
                    ->join('class_subjects', 'class_subjects.class_header_id', 'class_details.class_header_id')
                    ->where('roles.name','Student')
                    ->where('class_subjects.id', request('class_subject_id'))
                    ->get();

        foreach ($students as $student) {
            AttendanceDetail::create([
                'attendance_id' => $last_attendance->id,
                'student_user_id' => $student->studentId,
                'status' => request('present-'.$student->studentId) ? 'Present' : (request('sick-'.$student->studentId) ? 'Sick' : (request('absencePermit-'.$student->studentId) ? 'Absence Permit' : (request('absent-'.$student->studentId) ? 'Absent' : '')))
            ]);
        }

        return redirect()->route('attendance.view', request('class_subject_id'))->with('success', 'New Attendance created');
    }
}
