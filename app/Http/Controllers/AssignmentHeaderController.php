<?php

namespace App\Http\Controllers;

use App\Models\AssignmentDetail;
use App\Models\AssignmentHeader;
use App\Models\AssignmentScore;
use App\Models\ClassDetail;
use App\Models\ClassSubject;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class AssignmentHeaderController extends Controller
{

    public function index($classSubjectId)
    {
        if (auth()->user()->role->name == 'Teacher') {
            return view('assignment.index', [
                'assignments' => AssignmentHeader::select('assignment_headers.id', 'title', 'file', 'assignment_headers.end_time')
                    ->join('class_subjects', 'assignment_headers.class_subject_id', 'class_subjects.id')
                    ->where('class_subjects.id',   $classSubjectId)
                    ->where('class_subjects.teacher_user_id', auth()->user()->id)->orderBy('id', 'desc')->get(),
                'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name',
                    'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName',
                    'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'users.user_code as teacherNuptk')
                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                    ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                    ->join('users', 'users.id', 'class_subjects.teacher_user_id')
                    ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_user_id')
                    ->where('class_subjects.id', $classSubjectId)->first(),
            ]);
        } else {
            return view('assignment.index', [
                'assignments' => AssignmentHeader::select('assignment_headers.id', 'title', 'file', 'assignment_headers.end_time')
                    ->join('class_subjects', 'assignment_headers.class_subject_id', 'class_subjects.id')
                    ->where('class_subjects.id',   $classSubjectId)->orderBy('id', 'desc')->get(),
                'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name',
                    'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName',
                    'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'users.user_code as teacherNuptk')
                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                    ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                    ->join('users', 'users.id', 'class_subjects.teacher_user_id')
                    ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_user_id')
                    ->where('class_subjects.id', $classSubjectId)->first(),
            ]);
        }
    }

    public function store($classSubjectId, Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'end_time' => 'required',
            'file' => 'required|file|max:4999'
        ]);

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $file_name = 'ASG_' . $request->title . '_' . time() . '.' . $extension;

            $request->file('file')->storeAs('public/assignment', $file_name);
        } else {
            $file_name = NULL;
        }

        AssignmentHeader::create([
            'title' => $request->title,
            'class_subject_id' => $request->class_subject_id,
            'end_time' => $request->end_time,
            'file' => $file_name,
        ]);

        $assignment = DB::table('assignment_headers')->find(DB::table('assignment_headers')->max('id'));

        $students = ClassDetail::select('users.id as id')
        ->join('users', 'users.id', 'class_details.student_user_id')
        ->join('roles','roles.id','users.role_id')
        ->where('roles.name','Student')
        ->where('class_details.class_header_id', $classSubjectId)
        ->get();

        foreach ($students as $s) {
            AssignmentScore::create([
                'assignment_header_id' => $assignment->id,
                'student_user_id' => $s->id,
                'score' => 0
            ]);
        }

        return redirect()->back()->with('success', 'New Assignment Created');
    }

    
    public function update($assignmentId, Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'end_time' => 'required'
        ]);

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $file_name = 'ASG_' . $request->title . '_' . time() . '.' . $extension;

            $request->file('file')->storeAs('public/assignment', $file_name);
        } else {
            $file_name = $request->assignment_file;
        }

        $assignment = AssignmentHeader::find($assignmentId);

        $assignment->title = $request->title;
        $assignment->end_time = $request->end_time;
        $assignment->file = $file_name;
        
        $assignment->save();

        return redirect()->back()->with('success', 'New Assignment Created');
    }
}
