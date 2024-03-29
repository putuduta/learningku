<?php

namespace App\Http\Controllers;

use App\Models\AssignmentScore;
use App\Models\ClassDetail;
use Illuminate\Http\Request;
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
        $assignmentScores = AssignmentScore::join('assignment_header', 'assignment_header.assignment_header_id', 'assignment_score.assignment_header_id')
                            ->where('assignment_score.user_id', auth()->user()->user_id)
                            ->where('assignment_header.class_subject_id', $classSubjectId)
                            ->get();
    
        $examScores = ExamScore::where([['user_id', auth()->user()->user_id],['class_subject_id', $classSubjectId]])->get();

        return view('score.index', [
            'assignmentScores' => $assignmentScores,
            'examScores' => $examScores,
            'classSubject' => ClassSubject::select('class_subject.class_subject_id as id', 'class_subject.name as name',
                'class_header.name as className', 'school_year.year as schoolYear', 'school_year.semester as semester', 'user.name as teacherName',
                'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'user.user_code as teacherNuptk', 'minimum_score')
                ->join('class_header', 'class_header.class_header_id', 'class_subject.class_header_id')
                ->join('school_year', 'school_year.school_year_id', 'class_header.school_year_id')
                ->join('user', 'user.user_id', 'class_subject.user_id')
                ->join('user as userB', 'userB.user_id', 'class_header.user_id')
                ->find($classSubjectId),
            'overallScore' => $assignmentScores->count() > 0 && $examScores->count() > 0 ? round((AssignmentScore::join('assignment_header', 'assignment_header.assignment_header_id', 'assignment_score.assignment_header_id')
                                    ->where('assignment_score.user_id', auth()->user()->user_id)
                                    ->where('assignment_header.class_subject_id', $classSubjectId)->sum('assignment_score.score') + ExamScore::where([['user_id', auth()->user()->user_id],['class_subject_id', $classSubjectId]])->sum('score')) / (AssignmentScore::join('assignment_header', 'assignment_header.assignment_header_id', 'assignment_score.assignment_header_id')
                                    ->where('assignment_score.user_id', auth()->user()->user_id)
                                    ->where('assignment_header.class_subject_id', $classSubjectId)->count() + ExamScore::where([['user_id', auth()->user()->user_id],['class_subject_id', $classSubjectId]])->count())) : null
        ]);
    }

    public function indexTeacher($classSubjectId)
    {
        return view('score.index', [
            'classSubject' => ClassSubject::select('class_subject.class_subject_id as id', 'class_subject.name as name',
                'class_header.name as className', 'school_year.year as schoolYear', 'school_year.semester as semester', 'user.name as teacherName',
                'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'user.user_code as teacherNuptk', 'minimum_score')
                ->join('class_header', 'class_header.class_header_id', 'class_subject.class_header_id')
                ->join('school_year', 'school_year.school_year_id', 'class_header.school_year_id')
                ->join('user', 'user.user_id', 'class_subject.user_id')
                ->join('user as userB', 'userB.user_id', 'class_header.user_id')
                ->find($classSubjectId),
            'classDetails' => ClassDetail::select('user.user_id as studentId','user.name as studentName', 'user.user_code as studentNisn')
                        ->join('user','user.user_id','class_detail.user_id')
                        ->join('class_header', 'class_header.class_header_id', 'class_detail.class_header_id')
                        ->join('class_subject', 'class_header.class_header_id', 'class_subject.class_header_id')
                        ->where([['user.role_id','3'],['class_subject.class_subject_id', $classSubjectId]])
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
            'user_id' => $request->studentId,
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
        $assignmentScores = AssignmentScore::join('assignment_header', 'assignment_header.assignment_header_id', 'assignment_score.assignment_header_id')
                            ->where('assignment_score.user_id', $studentId)
                            ->where('assignment_header.class_subject_id', $classSubjectId)
                            ->get();
        
        $examScores = ExamScore::where([['user_id', $studentId],['class_subject_id', $classSubjectId]])->get();

        return view('score.show', [
            'classSubject' => ClassSubject::select('class_subject.class_subject_id as id', 'class_subject.name as name',
                'class_header.name as className', 'school_year.year as schoolYear', 'school_year.semester as semester', 'user.name as teacherName',
                'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'user.user_code as teacherNuptk', 'minimum_score', 'userc.user_id as studentId','userc.name as studentName', 'userc.user_code as studentNisn')
                ->join('class_header', 'class_header.class_header_id', 'class_subject.class_header_id')
                ->join('school_year', 'school_year.school_year_id', 'class_header.school_year_id')
                ->join('user', 'user.user_id', 'class_subject.user_id')
                ->join('user as userB', 'userB.user_id', 'class_header.user_id')
                ->join('class_detail', 'class_detail.class_header_id', 'class_header.class_header_id')
                ->join('user as userc', 'userc.user_id', 'class_detail.user_id')
                ->where([['userc.role_id','3'],['userc.user_id', $studentId]])
                ->find($classSubjectId),
            'assignmentScores' => $assignmentScores,
            'examScores' => $examScores,
            'overallScore' => $assignmentScores->count() > 0 && $examScores->count() > 0 ? round((AssignmentScore::join('assignment_header', 'assignment_header.assignment_header_id', 'assignment_score.assignment_header_id')
                                    ->where('assignment_score.user_id', $studentId)
                                    ->where('assignment_header.class_subject_id', $classSubjectId)->sum('assignment_score.score') + ExamScore::where([['user_id', $studentId],['class_subject_id', $classSubjectId]])->sum('score')) / (AssignmentScore::join('assignment_header', 'assignment_header.assignment_header_id', 'assignment_score.assignment_header_id')
                                    ->where('assignment_score.user_id', $studentId)
                                    ->where('assignment_header.class_subject_id', $classSubjectId)->count() + ExamScore::where([['user_id', $studentId],['class_subject_id', $classSubjectId]])->count())) : null
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
                'classSubjects' => ClassSubject::select('class_header.class_header_id as classId','class_header.name','school_year.year as schoolYear', 'school_year.semester as semester', 'user.name as homeroomTeacherName', 'class_header.user_id as homeroomTeacherId', 'user.user_code as homeRoomTeacherNuptk',
                                    'class_subject.class_subject_id as subjectId', 'class_subject.name as subjectName','user2.user_id as teacherId', 'user2.name as teacherName', 'user2.user_code as teacherNuptk')
                                    ->join('class_header', 'class_header.class_header_id', 'class_subject.class_header_id')    
                                    ->join('school_year','school_year.school_year_id','class_header.school_year_id')
                                    ->join('class_detail', 'class_detail.class_header_id', 'class_header.class_header_id')
                                    ->join('user', 'user.user_id', 'class_header.user_id')
                                    ->join('user as user2', 'user2.user_id', 'class_subject.user_id')
                                    ->join('role','role.role_id','user.role_id')
                                    ->where('role.name','Teacher')
                                    ->where('class_detail.user_id', auth()->user()->user_id)
                                    ->orderBy('class_header.school_year_id', 'DESC')->get()
            ]);
        } else {

            return view('score.index',[
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
