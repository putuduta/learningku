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
                    ->join('class_headers', 'assignment_headers.class_id', 'class_headers.id')
                    ->where('teacher_id', auth()->user()->id)->orderBy('id', 'desc')->get(),
                'class' => ClassHeader::where('id', $classId)
                ->first()
            ]);
        } else {
            return view('assignment.index', [
                'assignments' => AssignmentHeader::select('assignment_headers.id', 'title', 'file', 'assignment_headers.end_time')
                    ->join('class_headers', 'assignment_headers.class_id', 'class_headers.id')
                    ->join('class_details', 'class_details.class_header_id', 'class_headers.id')
                    ->where('class_details.id',   $classId)->orderBy('id', 'desc')->get(),
                'class' => ClassHeader::where('id', $classId)
                    ->first()
            ]);
        }
    }

    public function store(Request $request)
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
            'class_id' => $request->class_id,
            'end_time' => $request->end_time,
            'file' => $file_name,
        ]);

        return redirect()->back()->with('success', 'New Assignment Created');
    }

    public function show($assignmentId, $classId)
    {
        return view('assignment.show', [
            'assignment' => AssignmentHeader::where('id', $assignmentId)->first(),
            'class' => ClassHeader::where('id', $classId)->first(),
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
