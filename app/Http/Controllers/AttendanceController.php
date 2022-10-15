<?php

namespace App\Http\Controllers;

use App\Models\AttendanceDetail;
use App\Models\AttendanceHeader;
use App\Models\ClassDetail;
use App\Models\ClassHeader;
use Illuminate\Http\Request;
use App\Models\User;

class AttendanceController extends Controller
{
    public function viewTeacherList($classId)
    {

        $class = ClassHeader::where('id', $classId)->first();

        if ($class != NULL) {
            return view('attendance.teacher_list', [
                'attendances' => AttendanceHeader::select(
                    'attendance_headers.id',
                    'attendance_headers.class_id',
                    'attendance_headers.date'
                )->join('class_details', 'attendance_headers.class_id', 'class_details.id')
                ->join('class_headers', 'class_details.class_header_id', 'class_headers.id')
                    ->where('class_headers.teacher_id', auth()->user()->id)->get(),
                'class' => $class,
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function viewStudentList($classId)
    {
        return view('attendance.student_list', [
            'attendances' => AttendanceDetail::where('user_id', auth()->user()->id)->get(),
            'class' => ClassHeader::where('id', $classId)
            ->first()
        ]);
    }

    public function viewCreate()
    {

        $class = ClassDetail::where('homeroom_id', auth()->user()->id)->first();

        if (AttendanceHeader::where([['class_id', $class->id], ['date', date('y-m-d')]])->first() != NULL) {
            return redirect()->back()->with('error', 'You have submitted your attendance for your class today');
        } else {
            return view('attendance.create', [
                'class' => ClassDetail::where('homeroom_id', auth()->user()->id)->first(),
            ]);
        }
    }

    public function create()
    {

        AttendanceHeader::create([
            'class_id' => request('class_id'),
            'date' => date('y-m-d'),
        ]);

        $last_attendance = AttendanceHeader::where('class_id', request('class_id'))->latest('created_at')->first();

        $students = User::where('class_id', request('class_id'))->get();

        foreach ($students as $student) {
            AttendanceDetail::create([
                'attendance_id' => $last_attendance->id,
                'user_id' => $student->id,
                'is_attend' => request($student->id) ? 1 : 0,
            ]);
        }

        return redirect()->route('attendance.view-teacher-list')->with('success', 'New Attendance created');
    }
}
