<?php

namespace App\Http\Controllers;

use App\Models\AssignmentDetail;
use App\Models\AssignmentHeader;
use App\Models\AssignmentScore;
use Illuminate\Http\Request;

class AssignmentDetailController extends Controller
{

    public function submitAssignmentAnswer(Request $request, AssignmentHeader $assignmentHeader)
    {
        $this->validateData($request);

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $file_name = 'SUB_ASG_' . $assignmentHeader->title . '_' . auth()->user()->user_id . '_' . time() . '.' . $extension;

            $request->file('file')->storeAs('public/assignment/submission', $file_name);
        } else {
            $file_name = NULL;
        }

        AssignmentDetail::create([
            'assignment_header_id' => $assignmentHeader->id,
            'student_user_id' => auth()->user()->user_id,
            'file' => $file_name
        ]);

        // Students submit assignment set score back to null
        AssignmentScore::where([['assignment_header_id', $assignmentHeader->id],['student_user_id', auth()->user()->user_id]])
            ->update([
                'score' => null
            ]);

        return redirect()->back()->with('success', 'Assignment Submitted');
    }

    public function validateData($request) {
        $request->validate([
            'file' => 'required|file|max:4999'
        ]);
    }
}
