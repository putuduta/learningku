<?php

namespace App\Http\Controllers;

use App\Models\AssignmentHeader;
use App\Models\AssignmentScore;
use App\Models\ClassCourse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassHeader;
use App\Models\ClassSubject;
use App\Models\ExamScore;

class ScoreController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($classSubjectId)
    {
        if (auth()->user()->role->name == 'Student') {
            return view('score.index', [
                'assignmentScores' => AssignmentScore::where('student_user_id', auth()->user()->id)->get(),
                'examScores' => ExamScore::where([['student_user_id', auth()->user()->id],['class_subject_id', $classSubjectId]])->get(),
                'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name',
                    'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName',
                    'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'users.user_code as teacherNuptk', 'minimum_score')
                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                    ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                    ->join('users', 'users.id', 'class_subjects.teacher_user_id')
                    ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_user_id')
                    ->where('class_subjects.id', $classSubjectId)->first(),
            ]);
        } else {
            return view('score.index', [
                'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name',
                    'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName',
                    'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'users.user_code as teacherNuptk', 'minimum_score')
                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                    ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                    ->join('users', 'users.id', 'class_subjects.teacher_user_id')
                    ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_user_id')
                    ->where('class_subjects.id', $classSubjectId)->first(),
                'class_details' => User::select('users.id as studentId','users.name as studentName', 'users.user_code as studentNisn')
                ->join('class_details','class_details.student_user_id','users.id')
                ->where([['users.role_id','3'],['class_details.class_header_id', $classSubjectId]])
                ->get(),
                'assignmentScores' => AssignmentScore::get(),
                'examScores' => ExamScore::where('class_subject_id', $classSubjectId)->get()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($classCourseId, $userId)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAssignmentScore(Request $request)
    {
        $request->validate([
            'score' => 'required|integer',
        ]);

        $asg_score = AssignmentScore::find($request->score_id);

        $asg_score->score = $request->score;
        if ($request->notes != null) {
            $asg_score->notes = $request->notes;
        }

        $asg_score->save();

        return redirect()->back()->with('success', 'Assignment Score Added Successfully');
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeExamScore(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'score' => 'required|integer',
        ]);

        ExamScore::create([
            'student_user_id' => $request->studentId,
            'class_subject_id' => $request->classSubjectId,
            'name' => $request->name,
            'score' => $request->score
        ]);


        return redirect()->back()->with('success', 'Exam Score Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($studentId, $classSubjectId)
    {
        return view('score.show', [
            'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name',
                'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName',
                'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'users.user_code as teacherNuptk', 'minimum_score')
                ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                ->join('users', 'users.id', 'class_subjects.teacher_user_id')
                ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_user_id')
                ->where('class_subjects.id', $classSubjectId)->first(),
            'student' => User::select('users.id as studentId','users.name as studentName', 'users.user_code as studentNisn')
            ->join('class_details','class_details.student_user_id','users.id')
            ->where([['users.role_id','3'],['class_details.class_header_id', $classSubjectId],['users.id', $studentId]])
            ->first(),
            'assignmentScores' => AssignmentScore::where('student_user_id', $studentId)->get(),
            'examScores' => ExamScore::where('student_user_id', $studentId)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAssignmentScore(Request $request, AssignmentScore $score)
    {
        $request->validate([
            'score' => 'required|integer',
        ]);
        $score->update([
            'score' => $request->score,
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Assignment Score Updated');
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function UpdateExamScore(Request $request, ExamScore $score)
    {
        $request->validate([
            'name' => 'required|string',
            'score' => 'required|integer',
        ]);
        $score->update([
            'name' => $request->name,
            'score' => $request->score,
        ]);

        return redirect()->back()->with('success', 'Exam Score Updated');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
