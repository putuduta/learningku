<?php

namespace App\Http\Controllers;

use App\Models\AssignmentDetail;
use App\Models\AssignmentHeader;
use App\Models\AssignmentScore;
use App\Models\ClassDetail;
use App\Models\ClassSubject;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class AssignmentHeaderController extends Controller
{

    public function index($classSubjectId)
    {
        $classSubjects = ClassSubject::select('class_subject.class_subject_id as id', 'class_subject.name as name',
            'class_header.name as className', 'school_year.year as schoolYear', 'school_year.semester as semester', 'user.name as teacherName',
            'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'user.user_code as teacherNuptk')
            ->join('class_header', 'class_header.class_header_id', 'class_subject.class_header_id')
            ->join('school_year', 'school_year.school_year_id', 'class_header.school_year_id')
            ->join('user', 'user.user_id', 'class_subject.user_id')
            ->join('user as userB', 'userB.user_id', 'class_header.user_id')
            ->find($classSubjectId);

        
        $assignments = AssignmentHeader::select('assignment_header.assignment_header_id', 'title', 'file', 'assignment_header.end_time', 'class_subject.user_id')
            ->join('class_subject', 'assignment_header.class_subject_id', 'class_subject.class_subject_id')
            ->where('class_subject.class_subject_id',   $classSubjectId)->orderBy('assignment_header_id', 'desc')->get();

        return view('assignment.index', [
            'assignments' => (auth()->user()->role->name == 'Teacher') ? $assignments->where('user_id', auth()->user()->user_id) : $assignments,
            'classSubject' => $classSubjects
        ]);
    }

    public function viewAssignmentSubmission($assignmentId)
    {

        // $assignmentDetails = AssignmentDetail::select(DB::raw('assignment_details.*'))
        // ->join(DB::raw('(select assignment_header_id, user_id, max(id) as maxid from assignment_details group by assignment_header_id,user_id) b'), 'assignment_details.id','b.maxid')
        // ->where('assignment_details.assignment_header_id', $assignmentId);

        return view('assignment.show', [
            'assignmentSubmissions' => AssignmentHeader::select('assignment_details.id as id', 'assignment_details.assignment_header_id as assignmentId', 'assignment_header.title as assignmentTitle', 'assignment_details.file as file', 'assignment_details.created_at as createdAt', 'assignment_details.user_id as studentUserId', 'u.name as studentName', 'class_subject.class_subject_id as subjectId', 'class_subject.name as name',
                            'class_header.name as className')
                            ->joinSub(AssignmentDetail::select(DB::raw('assignment_details.*'))
                            ->join(DB::raw('(select assignment_header_id, user_id, max(id) as maxid from assignment_details group by assignment_header_id,user_id) b'), 'assignment_details.id','b.maxid')
                            ->where('assignment_details.assignment_header_id', $assignmentId), 'assignment_details', function (JoinClause $join) {
                                $join->on('assignment_header.assignment_header_id', '=', 'assignment_details.assignment_header_id');
                            })->join('user as u','u.id','assignment_details.user_id')
                            ->join('class_subject', 'class_subject.class_subject_id', 'assignment_header.class_subject_id')
                            ->join('class_header', 'class_header.class_header_id', 'class_subject.class_header_id')
                            ->where('assignment_header.assignment_header_id', $assignmentId)
                            ->get(),
            'assignmentScore' => AssignmentScore::select('assignment_score.assignment_score_id as id', 'assignment_score.assignment_header_id as assignmentHeaderId', 'assignment_score.score as score', 'user.user_id as studentUserId', 'user.name as studentName', 'user.user_code as nisn',  'assignment_score.notes as notes')
                                ->where('assignment_header_id', $assignmentId)
                                ->join('class_detail', 'class_detail.user_id', 'assignment_score.user_id')
                                ->join('user', 'user.user_id', 'assignment_score.user_id')->get()
        ]);
    }

    public function store($classSubjectId, Request $request)
    {
        $this->validateData($request, true);

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $file_name = 'ASG_' . $request->title . '_' . time() . '.' . $extension;

            $request->file('file')->storeAs('public/assignment', $file_name);
        } else {
            $file_name = NULL;
        }

        $assignment = AssignmentHeader::create([
            'title' => $request->title,
            'class_subject_id' => $request->class_subject_id,
            'end_time' => $request->end_time,
            'file' => $file_name,
        ]);

        $classDetails = ClassDetail::select('user.user_id as id')
                    ->join('user', 'user.user_id', 'class_detail.user_id')
                    ->join('role','role.role_id','user.role_id')
                    ->join('class_header', 'class_header.class_header_id', 'class_detail.class_header_id')
                    ->join('class_subject', 'class_subject.class_header_id', 'class_header.class_header_id')
                    ->where('role.name','Student')
                    ->where('class_subject.class_subject_id', $classSubjectId)
                    ->get();

        // Create assignment set score to 0
        foreach ($classDetails as $s) {
            AssignmentScore::create([
                'assignment_header_id' => $assignment->assignment_header_id,
                'user_id' => $s->id,
                'score' => 0
            ]);
        }

        return redirect()->back()->with('success', 'New Assignment Created');
    }

    
    public function update(AssignmentHeader $assignment, Request $request)
    {
        $this->validateData($request, false);

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $file_name = 'ASG_' . $request->title . '_' . time() . '.' . $extension;

            $request->file('file')->storeAs('public/assignment', $file_name);
        } else {
            $file_name = $request->assignment_file;
        }

        $assignment->update([
            'title' => $request->title,
            'end_time' => $request->end_time,
            'file' => $file_name,
        ]);

        return redirect()->back()->with('success', 'New Assignment Created');
    }

    public function validateData($request, $isInsert) {
        $request->validate([
            'title' => 'required|string',
            'end_time' => 'required'
        ]);

        if ($isInsert) {
            $request->validate([
                'file' => 'required|file|max:4999'
            ]);
        }
    }

    public function viewChooseClassSubject() {
        if (auth()->user()->role->name === 'Student') {
            return view('assignment.index', [
                'classSubjects' => ClassSubject::select('class_header.class_header_id as classId','class_header.name','school_year.year as schoolYear', 'school_year.semester as semester', 'user.name as homeroomTeacherName', 'class_header.user_id as homeroomTeacherId', 'user.user_code as homeRoomTeacherNuptk',
                                    'class_subject.class_subject_id as subjectId', 'class_subject.name as subjectName','user2.id as teacherId', 'user2.name as teacherName', 'user2.user_code as teacherNuptk')
                                    ->join('class_header', 'class_header.class_header_id', 'class_subject.class_header_id')    
                                    ->join('school_year','school_year.school_year_id','class_header.school_year_id')
                                    ->join('class_detail', 'class_detail.class_header_id', 'class_header.class_header_id')
                                    ->join('user', 'user.user_id', 'class_header.user_id')
                                    ->join('user as user2', 'user2.id', 'class_subject.user_id')
                                    ->join('role','role.role_id','user.role_id')
                                    ->where('role.name','Teacher')
                                    ->where('class_detail.user_id', auth()->user()->user_id)
                                    ->orderBy('class_header.school_year_id', 'DESC')->get()
            ]);
        } else {

            return view('assignment.index',[
                'classSubjects' => ClassSubject::select('class_subject.class_subject_id as id', 'class_subject.name as name', 'class_header.name as className', 'class_header.class_header_id as classId','user.user_id as teacherId', 'user.name as teacherName', 'user.user_code as teacherNuptk', 'userB.name as homeroomTeacherName', 'userB.user_code as homeroomTeacherNuptk', 'school_year.year as schoolYear', 'school_year.semester as semester', 'school_year.school_year_id as schoolYearId')
                                    ->join('user', 'user.user_id', 'class_subject.user_id')
                                    ->join('role','role.role_id','user.role_id')
                                    ->join('class_header', 'class_header.class_header_id', 'class_subject.class_header_id')
                                    ->join('school_year','school_year.school_year_id','class_header.school_year_id')
                                    ->join('user as userB', 'userB.user_id', 'class_header.user_id')
                                    ->where('role.name','Teacher')
                                    ->where('class_subject.user_id', auth()->user()->user_id)
                                    ->orderBy('class_header.school_year_id', 'DESC')->get()
            ]);
        }
    }
}
