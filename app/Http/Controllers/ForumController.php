<?php

namespace App\Http\Controllers;

use App\Models\ClassCourse;
use App\Models\ClassHeader;
use App\Models\ClassSubject;
use App\Models\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index($classSubjectId)
    {
        if (auth()->user()->role->name == 'Teacher') {
            return view('forum.index', [
                'forums' => Forum::select('forums.id', 'forums.user_id', 'forums.title', 'forums.class_subject_id')
                    ->join('class_subjects', 'forums.class_subject_id', 'class_subjects.id')
                    ->where('class_subjects.id', $classSubjectId)->orderBy('id', 'desc')->get(),
                'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name','class_subjects.description as description',
                    'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName')
                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                    ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                    ->join('teachers', 'teachers.user_id', 'class_subjects.teacher_user_id')
                    ->join('users', 'users.id', 'teachers.user_id')
                    ->where('class_subjects.class_header_id', $classSubjectId)->first(),
            ]);
        } else {
            return view('forum.index', [
                'forums' => Forum::select('forums.id', 'forums.user_id', 'forums.title', 'forums.class_subject_id')
                    ->join('class_subjects', 'forums.class_subject_id', 'class_subjects.id')
                    ->where('class_subjects.id', $classSubjectId)->orderBy('id', 'desc')->get(),
                'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name','class_subjects.description as description',
                    'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName')
                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                    ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                    ->join('teachers', 'teachers.user_id', 'class_subjects.teacher_user_id')
                    ->join('users', 'users.id', 'teachers.user_id')
                    ->where('class_subjects.class_header_id', $classSubjectId)->first(),
            ]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_subject_id' => 'required',
            'title' => 'required|string',
            'body' => 'required|string',
            'file' => 'nullable|max:4999|file',
        ]);

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $file_name = 'REPLY_' . $request->title . '_' . time() . '.' . $extension;

            $request->file('file')->storeAs('public/forum', $file_name);
        } else {
            $file_name = NULL;
        }

        Forum::create([
            'user_id' => auth()->user()->id,
            'class_subject_id' => $request->class_subject_id,
            'title' => $request->title,
            'body' => $request->body,
            'file' => $file_name,
        ]);

        return redirect()->back()->with('success', 'New Forum Created');
    }

    public function show($forumId, $classSubjectId)
    {
        return view('forum.show', [
            'forum' => Forum::where('id', $forumId)->first(),
            'classSubject' => ClassSubject::where('id', $classSubjectId)->first()
        ]);
    }

    public function update(Request $request, Forum $forum)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'file' => 'nullable|max:4999|file',
        ]);

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $file_name = 'FORUM_' . $request->title . '_' . time() . '.' . $extension;

            $request->file('file')->storeAs('public/forum', $file_name);
        } else {
            $file_name = $forum->file;
        }

        $forum->update([
            'title' => $request->title,
            'body' => $request->body,
            'file' => $file_name,
        ]);

        return redirect()->back()->with('success', 'Forum Updated');
    }

    public function destroy(Forum $forum)
    {
        $forum->delete();
        return redirect()->back()->with('success', 'Forum Deleted');
    }
}