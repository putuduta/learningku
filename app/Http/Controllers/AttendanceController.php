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
                ->where('class_subjects.user_id', auth()->user()->user_id)->get(),
            'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name',
                'class_headers.name as className', 'school_year.year as schoolYear', 'school_year.semester as semester', 'user.name as teacherName',
                'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'user.user_code as teacherNuptk')
                ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                ->join('school_year', 'school_year.school_year_id', 'class_headers.school_year_id')
                ->join('user', 'user.user_id', 'class_subjects.user_id')
                ->join('user as userB', 'userB.user_id', 'class_headers.user_id')
                ->find($classSubjectId)
        ]);
    }

    public function viewAttendanceStudent($classSubjectId)
    {
        return view('attendance.index', [
            'attendances' => AttendanceDetail::where('student_user_id', auth()->user()->user_id)->get(),
            'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name',
                'class_headers.name as className', 'school_year.year as schoolYear', 'school_year.semester as semester', 'user.name as teacherName',
                'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'user.user_code as teacherNuptk')
                ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                ->join('school_year', 'school_year.school_year_id', 'class_headers.school_year_id')
                ->join('user', 'user.user_id', 'class_subjects.user_id')
                ->join('user as userB', 'userB.user_id', 'class_headers.user_id')
                ->find($classSubjectId),
        ]);      
    }

    public function viewCreate($classSubjectId)
    {
        return view('attendance.create', [
            'classDetails' => ClassDetail::select('user.user_id as studentId', 'user.name as studentName', 'user.user_code as studentNisn', 'class_details.id as classDetailId',
                'class_subjects.id as id', 'class_subjects.name as name',
                'class_headers.name as className', 'school_year.year as schoolYear', 'school_year.semester as semester', 'userC.name as teacherName',
                'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'userC.user_code as teacherNuptk')
                ->join('user', 'user.user_id', 'class_details.student_user_id')
                ->join('roles','role.role_id','user.role_id')
                ->join('class_subjects', 'class_subjects.class_header_id', 'class_details.class_header_id')
                ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                ->join('school_year', 'school_year.school_year_id', 'class_headers.school_year_id')
                ->join('user as userB', 'userB.user_id', 'class_headers.user_id')
                ->join('user as userC', 'userC.id', 'class_subjects.user_id')
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

        $classDetails = ClassDetail::select('user.user_id as studentId', 'user.name as studentName', 'class_details.id as classDetailId')
                    ->join('user', 'user.user_id', 'class_details.student_user_id')
                    ->join('roles','role.role_id','user.role_id')
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
                'classSubjects' => ClassSubject::select('class_headers.id as classId','class_headers.name','school_year.year as schoolYear', 'school_year.semester as semester', 'user.name as homeroomTeacherName', 'class_headers.user_id as homeroomTeacherId', 'user.user_code as teacherNuptk',
                                    'class_subjects.id as subjectId', 'class_subjects.name as subjectName','user2.id as teacherId', 'user2.name as teacherName', 'user2.user_code as teacherNuptk')
                                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')    
                                    ->join('school_year','school_year.school_year_id','class_headers.school_year_id')
                                    ->join('class_details', 'class_details.class_header_id', 'class_headers.id')
                                    ->join('user', 'user.user_id', 'class_headers.user_id')
                                    ->join('user as user2', 'user2.id', 'class_subjects.user_id')
                                    ->join('roles','role.role_id','user.role_id')
                                    ->where('roles.name','Teacher')
                                    ->where('class_details.student_user_id', auth()->user()->user_id)
                                    ->orderBy('class_headers.school_year_id', 'DESC')->get()
            ]);
        } else {

            return view('attendance.index',[
                'classSubjects' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name', 'class_headers.name as className', 'class_headers.id as classId','user.user_id as teacherId', 'user.name as teacherName', 'user.user_code as teacherNuptk', 'userB.name as homeroomTeacherName', 'userB.user_code as homeroomTeacherNuptk', 'school_year.year as schoolYear', 'school_year.semester as semester', 'school_year.school_year_id as schoolYearId')
                                    ->join('user', 'user.user_id', 'class_subjects.user_id')
                                    ->join('roles','role.role_id','user.role_id')
                                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                                    ->join('school_year','school_year.school_year_id','class_headers.school_year_id')
                                    ->join('user as userB', 'userB.user_id', 'class_headers.user_id')
                                    ->where('roles.name','Teacher')
                                    ->where('class_subjects.user_id', auth()->user()->user_id)
                                    ->orderBy('class_headers.school_year_id', 'DESC')->get()
            ]);
        }
    }
}

