<?php

namespace App\Http\Controllers;

use App\Models\AssignmentDetail;
use App\Models\AssignmentHeader;
use App\Models\AssignmentScore;
use App\Models\ClassDetail;
use App\Models\ClassSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class AssignmentController extends Controller
{

    public function index($classSubjectId)
    {
        if (auth()->user()->role == 'Teacher') {
            return view('assignment.index', [
                'assignments' => AssignmentHeader::select('assignment_headers.id', 'title', 'file', 'assignment_headers.end_time')
                    ->join('class_subjects', 'assignment_headers.class_subject_id', 'class_subjects.id')
                    ->where('class_subjects.id',   $classSubjectId)
                    ->where('teacher_id', auth()->user()->id)->orderBy('id', 'desc')->get(),
                'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name','class_subjects.description as description',
                    'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName')
                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                    ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                    ->join('teachers', 'teachers.user_id', 'class_subjects.user_id')
                    ->join('users', 'users.id', 'teachers.user_id')
                    ->where('class_subjects.class_header_id', $classSubjectId)->first(),
            ]);
        } else {
            return view('assignment.index', [
                'assignments' => AssignmentHeader::select('assignment_headers.id', 'title', 'file', 'assignment_headers.end_time')
                    ->join('class_subjects', 'assignment_headers.class_subject_id', 'class_subjects.id')
                    ->where('class_subjects.id',   $classSubjectId)->orderBy('id', 'desc')->get(),
                    'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name','class_subjects.description as description',
                    'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName')
                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                    ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                    ->join('teachers', 'teachers.user_id', 'class_subjects.user_id')
                    ->join('users', 'users.id', 'teachers.user_id')
                    ->where('class_subjects.class_header_id', $classSubjectId)->first(),
            ]);
        }
    }

    public function addAssignment($classSubjectId, Request $request)
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
        ->join('students', 'students.user_id', 'class_details.user_id')
        ->join('users', 'users.id', 'students.user_id')
        ->join('roles','roles.id','users.role_id')
        ->where('roles.name','Student')
        ->where('class_details.class_header_id', $classSubjectId)
        ->get();

        foreach ($students as $s) {
            AssignmentScore::create([
                'assignment_header_id' => $assignment->id,
                'student_user_id' => $s->id
            ]);
        }

        return redirect()->back()->with('success', 'New Assignment Created');
    }
    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required|string',
        //     'end_time' => 'required',
        //     'file' => 'required|file|max:4999'
        // ]);

        // if ($request->hasFile('file')) {
        //     $extension = $request->file('file')->getClientOriginalExtension();
        //     $file_name = 'ASG_' . $request->title . '_' . time() . '.' . $extension;

        //     $request->file('file')->storeAs('public/assignment', $file_name);
        // } else {
        //     $file_name = NULL;
        // }

        // AssignmentHeader::create([
        //     'title' => $request->title,
        //     'class_subject_id' => $request->class_subject_id,
        //     'end_time' => $request->end_time,
        //     'file' => $file_name,
        // ]);

        // $assignment = DB::table('assignment_headers')->find(DB::table('assignment_headers')->max('id'));

        // $students = ClassDetail::select('users.id as id', 'users.name as name', 'class_details.id as classDetailId')
        // ->join('students', 'students.user_id', 'class_details.user_id')
        // ->join('users', 'users.id', 'students.user_id')
        // ->join('roles','roles.id','users.role_id')
        // ->where('roles.name','Student')
        // ->where('class_details.class_header_id', $class->id)
        // ->get();

        // return redirect()->back()->with('success', 'New Assignment Created');
    }

    public function show($assignmentId, $classSubjectId)
    {
        return view('assignment.show', [
            'assignments' => DB::table('assignment_details as a')->select('a.id as id', 'a.assignment_id as assignmentId', 'c.title as assignmentTitle', 'a.file as file', 'a.created_at as createdAt', 'a.student_user_id as studentUserId', 'u.name as studentName')->where('a.assignment_id', $assignmentId)->where('a.id', function ($query) {
                $query->select(DB::raw('max(id) as id'))
                ->from('assignment_details as b')
                ->whereRaw('b.student_user_id = a.student_user_id');
            })->join('assignment_headers as c','c.id','a.assignment_id')->join('users as u','u.id','a.student_user_id')->get(),
            'classSubject' => ClassSubject::where('id', $classSubjectId)->first(),
        ]);
    }

    public function submit(Request $request, AssignmentHeader $assignmentHeader)
    {
        $request->validate([
            'file' => 'required|file|max:4999'
        ]);

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $file_name = 'SUB_ASG_' . $assignmentHeader->title . '_' . auth()->user()->id . '_' . time() . '.' . $extension;

            $request->file('file')->storeAs('public/assignment/submission', $file_name);
        } else {
            $file_name = NULL;
        }

        AssignmentDetail::create([
            'assignment_id' => $assignmentHeader->id,
            'student_user_id' => auth()->user()->id,
            'file' => $file_name,
        ]);

        return redirect()->back()->with('success', 'Assignment Submitted');
    }
}
