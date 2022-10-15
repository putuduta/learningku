<?php

namespace App\Http\Controllers;

use App\Models\AssignmentDetail;
use App\Models\AssignmentHeader;
use App\Models\ClassCourse;
use App\Models\ClassHeader;
use Illuminate\Http\Request;
use PDO;

class AssignmentController extends Controller
{

    public function index($classId)
    {
        if (auth()->user()->role == 'Teacher') {
            return view('assignment.index', [
                'assignments' => AssignmentHeader::select('assignment_headers.id', 'title', 'file', 'assignment_headers.end_time')
                    ->join('class_courses', 'assignment_headers.class_course_id', 'class_courses.id')
                    ->where('teacher_id', auth()->user()->id)->orderBy('id', 'desc')->get(),
                'class_courses' => ClassCourse::where('teacher_id', auth()->user()->id)->get(),
                'class' => ClassHeader::where('id', $classId)
                ->first()
            ]);
        } else {
            return view('assignment.index', [
                'assignments' => AssignmentHeader::select('assignment_headers.id', 'title', 'file', 'assignment_headers.end_time')
                    ->join('class_courses', 'assignment_headers.class_course_id', 'class_courses.id')
                    ->where('class_id',   auth()->user()->class_id)->orderBy('id', 'desc')->get(),
                'class' => ClassHeader::where('id', $classId)
                    ->first()
            ]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_course_id' => 'required',
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
            'class_course_id' => $request->class_course_id,
            'title' => $request->title,
            'end_time' => $request->end_time,
            'file' => $file_name,
        ]);

        return redirect()->back()->with('success', 'New Assignment Created');
    }

    public function show(AssignmentHeader $assignmentHeader)
    {
        return view('assignment.show', [
            'assignment' => $assignmentHeader,
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
            'user_id' => auth()->user()->id,
            'file' => $file_name,
        ]);

        return redirect()->back()->with('success', 'Assignment Submitted');
    }
}
