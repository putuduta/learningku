<?php

namespace App\Http\Controllers;

use App\Models\AssignmentHeader;
use App\Models\Score;
use App\Models\ClassCourse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassHeader;
use App\Models\ClassSubject;

class ScoreController extends Controller
{
    public function manage($classSubjectId)
    {
        return view('score.manage', [
            'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name',
                    'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName')
                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                    ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                    ->join('teachers', 'teachers.user_id', 'class_subjects.teacher_user_id')
                    ->join('users', 'users.id', 'teachers.user_id')
                    ->where('class_subjects.id', $classSubjectId)->first(),
            'class_details' => User::select('users.id as studentId','users.name as studentName')
            ->join('class_details','class_details.student_user_id','users.id')
            ->where([['users.role_id','3'],['class_details.class_header_id', $classSubjectId]])
            ->get(),
        ]);
    }

    public function detail($classId, User $student)
    {
        return view('score.show', [
            'scores' => Score::where('student_user_id', $student->id)->get(),
            'student' => $student,
            'class' => $classId
        ]);
    }

    public function change($classId, Score $score)
    {
        return view('score.change', [
            'score' => $score,
            'class' => $classId
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($classSubjectId)
    {
        if (auth()->user()->role->name == 'Student') {
            return view('score.index', [
                'scores' => Score::where('student_user_id', auth()->user()->id)->get(),
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
                'scores' => Score::get()
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
    public function store(Request $request)
    {
        $request->validate([
            'score' => 'required|integer',
        ]);

        $asg_score = Score::find($request->score_id);

        $asg_score->score = $request->score;
        if ($request->notes != null) {
            $asg_score->notes = $request->notes;
        }

        $asg_score->save();

        return redirect()->back()->with('success', 'Score Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $student)
    {
        return view('score.show', [
            'scores' => Score::where('student_id', $student->id)->get(),
            'student' => $student
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
    public function update(Request $request, Score $score)
    {
        $request->validate([
            'score' => 'required|integer',
        ]);
        $score->update([
            'score' => $request->score,
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Score Updated');
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
