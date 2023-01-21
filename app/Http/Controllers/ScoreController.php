<?php

namespace App\Http\Controllers;

use App\Models\ClassCourse;
use App\Models\ClassDetail;
use Illuminate\Http\Request;
use App\Models\Score;
use App\Models\User;
use App\Models\ClassHeader;

class ScoreController extends Controller
{
    public function manage($classId)
    {
        // if ($id == 0) {
        //     $class_course = ClassCourse::where('teacher_id', auth()->user()->id)->first();
        // } else {
        //     $class_course = ClassCourse::find($id);
        // }

        // return view('score.manage', [
        //     'class_courses' => ClassCourse::where('teacher_id', auth()->user()->id)->get(),
        //     // 'class_course' => $class_course,
        //     'class' => ClassHeader::where('id', $classId)
        //     ->first()
        // ]);

        return view('score.manage', [
            'class' => ClassHeader::where('id', $classId)->first(),
            'class_details' => User::select('users.id as studentId','users.name as studentName')
            ->join('class_details','class_details.student_id','users.id')
            ->where([['users.role','Student'],['class_details.class_header_id', $classId]])
            ->get(),
        ]);
    }

    // public function detail(User $student)
    // {
    //     return view('score.show', [
    //         'scores' => Score::where('student_id', $student->id)->get(),
    //         'student' => $student,
    //         // 'class' => ClassHeader::where('id', $classId)
    //         // ->first()
    //     ]);
    // }

    public function detail($classId, User $student)
    {
        return view('score.show', [
            'scores' => Score::where('student_id', $student->id)->get(),
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
    public function index($classId)
    {
        return view('score.index', [
            'scores' => Score::where('student_id', auth()->user()->id)->get(),
            'class' => ClassHeader::where('id', $classId)
            ->first()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($classCourseId, $userId)
    {
        $score = Score::where([['class_course_id', $classCourseId], ['user_id', $userId]])->first();

        if ($score) return redirect()->route('score.edit', $score->id);
        else {
            return view('score.create', [
                'class_course' => ClassCourse::find($classCourseId),
                'user' => User::find($userId),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $request->validate([
        //     'title' => 'required|string',
        //     'end_time' => 'required',
        //     'file' => 'required|file|max:4999'
        // ]);

        // if ($request->hasFile('file')) {
        //     $extension = $request->file('file')->getClientOriginalExtension();
        //     $file_name = 'ASG_' . $request->title . '_' . time() . '.' . $extension;

        //     $request->file('file')->storeAs('public/assignment', $file_name);
        // } else {
        //     $file_name = NULL;
        // }

        // AssignmentHeader::create([
        //     'title' => $request->title,
        //     'class_id' => $request->class_id,
        //     'end_time' => $request->end_time,
        //     'file' => $file_name,
        // ]);

        // return redirect()->back()->with('success', 'New Assignment Created');
        $request->validate([
            'score_name' => 'required|string',
            'score' => 'required|integer',
        ]);

        Score::create([
            'class_header_id' => $request->class_id,
            'student_id' => $request->student_id,
            'score_name' => $request->score_name,
            'score' => $request->score,
        ]);

        return redirect()->back()->with('success', 'Score Created');
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
            // 'class' => ClassHeader::where('id', $classId)
            // ->first()
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
        return view('score.edit', [
            'score' => Score::find($id),
        ]);
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
        // $request->validate([
        //     'title' => 'required|string',
        //     'body' => 'required|string',
        //     'file' => 'nullable|max:4999|file',
        // ]);

        // if ($request->hasFile('file')) {
        //     $extension = $request->file('file')->getClientOriginalExtension();
        //     $file_name = 'THREAD_' . $request->title . '_' . time() . '.' . $extension;

        //     $request->file('file')->storeAs('public/forum', $file_name);
        // } else {
        //     $file_name = $thread->file;
        // }

        // $thread->update([
        //     'title' => $request->title,
        //     'body' => $request->body,
        //     'file' => $file_name,
        // ]);

        // return redirect()->back()->with('success', 'Thread Updated');
        
        $request->validate([
            'score_name' => 'required|string',
            'score' => 'required|integer',
        ]);

        $score->update([
            'score_name' => $request->score_name,
            'score' => $request->score,
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
