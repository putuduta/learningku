<?php

namespace App\Http\Controllers;

use App\Models\ClassCourse;
use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'Teacher') {
            return view('thread.index', [
                'threads' => Thread::select('threads.id', 'threads.user_id', 'threads.title', 'threads.class_course_id')
                    ->join('class_courses', 'threads.class_course_id', 'class_courses.id')
                    ->where('teacher_id', auth()->user()->id)->orderBy('id', 'desc')->get(),
                'class_courses' => ClassCourse::where('teacher_id', auth()->user()->id)->get(),
            ]);
        } else {
            return view('thread.index', [
                'threads' => Thread::select('threads.id', 'threads.user_id', 'threads.title', 'threads.class_course_id')
                    ->join('class_courses', 'threads.class_course_id', 'class_courses.id')
                    ->where('class_id', auth()->user()->class_id)->orderBy('id', 'desc')->get(),
                'class_courses' => ClassCourse::where('class_id', auth()->user()->class_id)->get(),
            ]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_course_id' => 'required',
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

        Thread::create([
            'user_id' => auth()->user()->id,
            'class_course_id' => $request->class_course_id,
            'title' => $request->title,
            'body' => $request->body,
            'file' => $file_name,
        ]);

        return redirect()->back()->with('success', 'New Thread Created');
    }

    public function show(Thread $thread)
    {
        return view('thread.show', [
            'thread' => $thread,
        ]);
    }

    public function update(Request $request, Thread $thread)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'file' => 'nullable|max:4999|file',
        ]);

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $file_name = 'THREAD_' . $request->title . '_' . time() . '.' . $extension;

            $request->file('file')->storeAs('public/forum', $file_name);
        } else {
            $file_name = $thread->file;
        }

        $thread->update([
            'title' => $request->title,
            'body' => $request->body,
            'file' => $file_name,
        ]);

        return redirect()->back()->with('success', 'Thread Updated');
    }

    public function destroy(Thread $thread)
    {
        $thread->delete();
        return redirect()->back()->with('success', 'Thread Deleted');
    }
}
