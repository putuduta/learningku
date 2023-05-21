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

        $classSubjects = ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name',
            'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName',
            'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'users.user_code as teacherNuptk')
            ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
            ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
            ->join('users', 'users.id', 'class_subjects.teacher_user_id')
            ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_user_id')
            ->find($classSubjectId);

        
        $assignments = AssignmentHeader::select('assignment_headers.id', 'title', 'file', 'assignment_headers.end_time', 'class_subjects.teacher_user_id')
            ->join('class_subjects', 'assignment_headers.class_subject_id', 'class_subjects.id')
            ->where('class_subjects.id',   $classSubjectId)->orderBy('id', 'desc')->get();

        return view('assignment.index', [
            'assignments' => (auth()->user()->role->name == 'Teacher') ? $assignments->where('teacher_user_id', auth()->user()->id) : $assignments,
            'classSubject' => $classSubjects,
        ]);
    }

    public function viewAssignmentSubmission($assignmentId)
    {

        // $assignmentDetails = AssignmentDetail::select(DB::raw('assignment_details.*'))
        // ->join(DB::raw('(select assignment_header_id, student_user_id, max(id) as maxid from assignment_details group by assignment_header_id,student_user_id) b'), 'assignment_details.id','b.maxid')
        // ->where('assignment_details.assignment_header_id', $assignmentId);

        return view('assignment.show', [
            'assignmentSubmissions' => AssignmentHeader::select('assignment_details.id as id', 'assignment_details.assignment_header_id as assignmentId', 'assignment_headers.title as assignmentTitle', 'assignment_details.file as file', 'assignment_details.created_at as createdAt', 'assignment_details.student_user_id as studentUserId', 'u.name as studentName', 'class_subjects.id as subjectId', 'class_subjects.name as name',
                            'class_headers.name as className')
                            ->joinSub(AssignmentDetail::select(DB::raw('assignment_details.*'))
                            ->join(DB::raw('(select assignment_header_id, student_user_id, max(id) as maxid from assignment_details group by assignment_header_id,student_user_id) b'), 'assignment_details.id','b.maxid')
                            ->where('assignment_details.assignment_header_id', $assignmentId), 'assignment_details', function (JoinClause $join) {
                                $join->on('assignment_headers.id', '=', 'assignment_details.assignment_header_id');
                            })->join('users as u','u.id','assignment_details.student_user_id')
                            ->join('class_subjects', 'class_subjects.id', 'assignment_headers.class_subject_id')
                            ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                            ->where('assignment_headers.id', $assignmentId)
                            ->get(),
            'assignmentScore' => AssignmentScore::select('assignment_scores.id as id', 'assignment_scores.assignment_header_id as assignmentHeaderId', 'assignment_scores.score as score', 'users.id as studentUserId', 'users.name as studentName', 'users.user_code as nisn',  'assignment_scores.notes as notes')
                                ->where('assignment_header_id', $assignmentId)
                                ->join('class_details', 'class_details.student_user_id', 'assignment_scores.student_user_id')
                                ->join('users', 'users.id', 'assignment_scores.student_user_id')->get()
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

        $classDetails = ClassDetail::select('users.id as id')
                    ->join('users', 'users.id', 'class_details.student_user_id')
                    ->join('roles','roles.id','users.role_id')
                    ->join('class_headers', 'class_headers.id', 'class_details.class_header_id')
                    ->join('class_subjects', 'class_subjects.class_header_id', 'class_headers.id')
                    ->where('roles.name','Student')
                    ->where('class_subjects.id', $classSubjectId)
                    ->get();

        // Create assignment set score to 0
        foreach ($classDetails as $s) {
            AssignmentScore::create([
                'assignment_header_id' => $assignment->id,
                'student_user_id' => $s->id,
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
                'classSubjects' => ClassSubject::select('class_headers.id as classId','class_headers.name','school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as homeroomTeacherName', 'class_headers.homeroom_teacher_user_id as homeroomTeacherId', 'users.user_code as homeRoomTeacherNuptk',
                                    'class_subjects.id as subjectId', 'class_subjects.name as subjectName','user2.id as teacherId', 'user2.name as teacherName', 'user2.user_code as teacherNuptk')
                                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')    
                                    ->join('school_years','school_years.id','class_headers.school_year_id')
                                    ->join('class_details', 'class_details.class_header_id', 'class_headers.id')
                                    ->join('users', 'users.id', 'class_headers.homeroom_teacher_user_id')
                                    ->join('users as user2', 'user2.id', 'class_subjects.teacher_user_id')
                                    ->join('roles','roles.id','users.role_id')
                                    ->where('roles.name','Teacher')
                                    ->where('class_details.student_user_id', auth()->user()->id)
                                    ->orderBy('class_headers.school_year_id', 'DESC')->get()
            ]);
        } else {

            return view('assignment.index',[
                'classSubjects' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name', 'class_headers.name as className', 'class_headers.id as classId','users.id as teacherId', 'users.name as teacherName', 'users.user_code as teacherNuptk', 'userB.name as homeroomTeacherName', 'userB.user_code as homeroomTeacherNuptk', 'school_years.year as schoolYear', 'school_years.semester as semester', 'school_years.id as schoolYearId')
                                    ->join('users', 'users.id', 'class_subjects.teacher_user_id')
                                    ->join('roles','roles.id','users.role_id')
                                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                                    ->join('school_years','school_years.id','class_headers.school_year_id')
                                    ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_user_id')
                                    ->where('roles.name','Teacher')
                                    ->where('class_subjects.teacher_user_id', auth()->user()->id)
                                    ->orderBy('class_headers.school_year_id', 'DESC')->get()
            ]);
        }
    }
}
