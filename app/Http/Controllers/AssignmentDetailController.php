<?php

namespace App\Http\Controllers;

use App\Models\AssignmentDetail;
use App\Models\AssignmentHeader;
use App\Models\AssignmentScore;
use App\Models\ClassDetail;
use App\Models\ClassSubject;
use App\Models\Score;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class AssignmentDetailController extends Controller
{

    public function viewAssignmentSubmission($assignmentId, $classSubjectId)
    {

        $assignmentDetails = AssignmentDetail::select(DB::raw('assignment_details.*'))
        ->join(DB::raw('(select assignment_header_id, student_user_id, max(id) as maxid from assignment_details group by assignment_header_id,student_user_id) b'), 'assignment_details.id','b.maxid')
        ->where('assignment_details.assignment_header_id', $assignmentId);

        return view('assignment.show', [
            'assignments' => DB::table('assignment_headers as c')->select('assignment_details.id as id', 'assignment_details.assignment_header_id as assignmentId', 'c.title as assignmentTitle', 'assignment_details.file as file', 'assignment_details.created_at as createdAt', 'assignment_details.student_user_id as studentUserId', 'u.name as studentName')
            ->joinSub($assignmentDetails, 'assignment_details', function (JoinClause $join) {
                $join->on('c.id', '=', 'assignment_details.assignment_header_id');
            })->join('users as u','u.id','assignment_details.student_user_id')->where('c.id', $assignmentId)->get(),
            'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name',
                'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName')
                ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                ->join('users', 'users.id', 'class_subjects.teacher_user_id')
                ->where('class_subjects.id', $classSubjectId)->first(),
            'assignmentScore' => AssignmentScore::select('assignment_scores.id as id', 'assignment_scores.assignment_header_id as assignmentHeaderId', 'assignment_scores.score as score', 'users.id as studentUserId', 'users.name as studentName', 'users.user_code as nisn',  'assignment_scores.notes as notes')
                                ->where('assignment_header_id', $assignmentId)
                                ->join('class_details', 'class_details.student_user_id', 'assignment_scores.student_user_id')
                                ->join('users', 'users.id', 'assignment_scores.student_user_id')->get(),
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
            'assignment_header_id' => $assignmentHeader->id,
            'student_user_id' => auth()->user()->id,
            'file' => $file_name
        ]);

        // Students submit assignment set score back to null
        $asg_score = AssignmentScore::where([['assignment_header_id', $assignmentHeader->id],['student_user_id', auth()->user()->id]])->first();
        $asg_score->score = null;
        $asg_score->save();

        return redirect()->back()->with('success', 'Assignment Submitted');
    }
}
