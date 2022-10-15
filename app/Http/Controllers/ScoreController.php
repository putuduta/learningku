<?php

namespace App\Http\Controllers;

use App\Models\ClassCourse;
use Illuminate\Http\Request;
use App\Models\Score;
use App\Models\User;
use App\Models\ClassHeader;

class ScoreController extends Controller
{
    public function manage($id, $classId)
    {
        if ($id == 0) {
            $class_course = ClassCourse::where('teacher_id', auth()->user()->id)->first();
        } else {
            $class_course = ClassCourse::find($id);
        }

        return view('score.manage', [
            'class_courses' => ClassCourse::where('teacher_id', auth()->user()->id)->get(),
            'class_course' => $class_course,
            'class' => ClassHeader::where('id', $classId)
            ->first()
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
            'scores' => Score::where('user_id', auth()->user()->id)->get(),
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
        $request->validate([
            'class_course_id' => 'required|integer',
            'user_id' => 'required|integer',
            'assignment' => 'nullable|integer',
            'mid' => 'nullable|integer',
            'final' => 'nullable|integer',
        ]);

        Score::create([
            'class_course_id' => $request->class_course_id,
            'user_id' => $request->user_id,
            'assignment' => $request->assignment,
            'mid' => $request->mid,
            'final' => $request->final,
        ]);

        return redirect()->route('score.manage', $request->class_course_id)->with('success', 'Score Updated');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        $request->validate([
            'assignment' => 'nullable|integer',
            'mid' => 'nullable|integer',
            'final' => 'nullable|integer'
        ]);

        $score->update([
            'assignment' => $request->assignment,
            'mid' => $request->mid,
            'final' => $request->final,
        ]);

        return redirect()->route('score.manage', $score->class_course_id)->with('success', 'Score Updated');
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
