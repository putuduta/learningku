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

class AssignmentDetailController extends Controller
{

    public function viewAssignmentSubmission($assignmentId, $classSubjectId)
    {
        return view('assignment.show', [
            'assignments' => DB::table('assignment_details as a')->select('a.id as id', 'a.assignment_id as assignmentId', 'c.title as assignmentTitle', 'a.file as file', 'a.created_at as createdAt', 'a.student_user_id as studentUserId', 'u.name as studentName')->where('a.assignment_id', $assignmentId)->where('a.id', function ($query) {
                $query->select(DB::raw('max(id) as id'))
                ->from('assignment_details as b')
                ->whereRaw('b.student_user_id = a.student_user_id');
            })->join('assignment_headers as c','c.id','a.assignment_id')->join('users as u','u.id','a.student_user_id')->get(),
            'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name','class_subjects.description as description',
                'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName')
                ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                ->join('teachers', 'teachers.user_id', 'class_subjects.teacher_user_id')
                ->join('users', 'users.id', 'teachers.user_id')
                ->where('class_subjects.id', $classSubjectId)->first(),
            'assignmentScore' => AssignmentScore::select('assignment_scores.id as id', 'assignment_scores.assignment_header_id as assignmentHeaderId', 'assignment_scores.score as score', 'users.id as studentUserId', 'users.name as studentName', 'students.nisn')
                                ->where('assignment_header_id', $assignmentId)
                                ->join('class_details', 'class_details.student_user_id', 'assignment_scores.student_user_id')
                                ->join('users', 'users.id', 'assignment_scores.student_user_id')
                                ->join('students', 'students.user_id', 'class_details.student_user_id')->get(),
            'assignmentHeader' => AssignmentHeader::where('id', $assignmentId)->first()
        ]);
    }

    public function submitAssignmentAnswer(Request $request, AssignmentHeader $assignmentHeader)
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

        // Students submit assignment set score back to null
        $asg_score = AssignmentScore::where('assignment_header_id', $assignmentHeader->id);
        $asg_score->score = null;
        $asg_score->save();

        return redirect()->back()->with('success', 'Assignment Submitted');
    }
}
