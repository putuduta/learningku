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
    public function viewTeacherList($classSubjectId)
    {

        $classSubject = ClassSubject::where('id', $classSubjectId)->first();

        if ($classSubject != NULL) {
            return view('attendance.teacher_list', [
                'attendances' => AttendanceHeader::select(
                    'attendance_headers.id',
                    'attendance_headers.class_subject_id',
                    'attendance_headers.date'
                )->join('class_subjects', 'attendance_headers.class_subject_id', 'class_subjects.id')
                    ->where('class_subjects.user_id', auth()->user()->id)->get(),
                'class' => $classSubject,
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function viewStudentList($classSubjectId)
    {
        return view('attendance.student_list', [
            'attendances' => AttendanceDetail::where('student_user_id', auth()->user()->id)->get(),
            'classSubject' => ClassSubject::where('id', $classSubjectId)
            ->first()
        ]);
    }

    public function viewCreate($classSubjectId)
    {

        if (AttendanceHeader::where([['class_subject_id', $classSubjectId], ['date', date('y-m-d')]])->first() != NULL) {
            return redirect()->back()->with('error', 'You have submitted your attendance for your class today');
        } else {
            return view('attendance.create', [
                'class' => ClassSubject::where('id', $classSubjectId)->first(),
                'class_details' => ClassDetail::select('users.id as studentId', 'users.name as studentName', 'class_details.id as classDetailId')
                    ->join('students', 'students.user_id', 'class_details.user_id')
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
            'class_id' => request('class_id'),
            'date' => date('y-m-d'),
        ]);

        $last_attendance = AttendanceHeader::where('class_subject_id', request('class_subject_id'))->latest('created_at')->first();

        $students = ClassDetail::select('users.id as studentId', 'users.name as studentName', 'class_details.id as classDetailId')
                    ->join('students', 'students.user_id', 'class_details.user_id')
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
                'is_attend' => request($student->studentId) ? 1 : 0,
            ]);
        }

        return redirect()->route('attendance.view-teacher-list', request('class_id'))->with('success', 'New Attendance created');
    }
}
