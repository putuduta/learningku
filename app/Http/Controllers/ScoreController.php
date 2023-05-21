<?php

namespace App\Http\Controllers;

use App\Models\AssignmentScore;
use App\Models\ClassDetail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassSubject;
use App\Models\ExamScore;

class ScoreController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexStudent($classSubjectId)
    {
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
                ->find($classSubjectId),
        ]);
    }

    public function indexTeacher($classSubjectId)
    {
        return view('score.index', [
            'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name',
                'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName',
                'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'users.user_code as teacherNuptk', 'minimum_score')
                ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                ->join('users', 'users.id', 'class_subjects.teacher_user_id')
                ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_user_id')
                ->find($classSubjectId),
            'classDetails' => ClassDetail::select('users.id as studentId','users.name as studentName', 'users.user_code as studentNisn')
                        ->join('users','users.id','class_details.student_user_id')
                        ->join('class_headers', 'class_headers.id', 'class_details.class_header_id')
                        ->join('class_subjects', 'class_headers.id', 'class_subjects.class_header_id')
                        ->where([['users.role_id','3'],['class_subjects.id', $classSubjectId]])
                        ->get()
        ]);
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAssignmentScore(AssignmentScore $score, Request $request)
    {
        $this->validateAsgScore($request);

        $score->update([
            'score' => $request->score,
            'notes' => $request->notes != null ? $request->notes : null
        ]);

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
        $this->validateAsgScore($request);

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
                'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'users.user_code as teacherNuptk', 'minimum_score', 'userc.id as studentId','userc.name as studentName', 'userc.user_code as studentNisn')
                ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                ->join('users', 'users.id', 'class_subjects.teacher_user_id')
                ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_user_id')
                ->join('class_details', 'class_details.class_header_id', 'class_headers.id')
                ->join('users as userc', 'userc.id', 'class_details.student_user_id')
                ->where([['userc.role_id','3'],['userc.id', $studentId]])
                ->find($classSubjectId),
            'assignmentScores' => AssignmentScore::where('student_user_id', $studentId)->get(),
            'examScores' => ExamScore::where([['student_user_id', $studentId],['class_subject_id', $classSubjectId]])->get()
        ]);
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
        $this->validateAsgScore($request);

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

        $this->validateAsgScore($request);

        $score->update([
            'name' => $request->name,
            'score' => $request->score,
        ]);

        return redirect()->back()->with('success', 'Exam Score Updated');
    }

    public function validateExamScore($request) {
        $request->validate([
            'name' => 'required|string',
            'score' => 'required|integer',
        ]);
    }

    public function validateAsgScore($request) {
        $request->validate([
            'score' => 'required|integer',
        ]);
    }

    public function viewChooseClassSubject() {
        if (auth()->user()->role->name === 'Student') {
            return view('score.index', [
                'classSubjects' => ClassSubject::select('class_headers.id as classId','class_headers.name','school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as homeroomTeacherName', 'class_headers.homeroom_teacher_user_id as homeroomTeacherId', 'users.user_code as teacherNuptk',
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

            return view('score.index',[
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
