<?php

namespace App\Http\Controllers;

use App\Models\ReplyThread;
use Illuminate\Http\Request;

class ReplyThreadController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|string',
            'file' => 'nullable|max:4999|file',
            'thread_id' => 'required'
        ]);

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $file_name = 'REPLY_' . $request->thread_id . '_' . time() . '.' . $extension;

            $request->file('file')->storeAs('public/forum', $file_name);
        } else {
            $file_name = NULL;
        }

        ReplyThread::create([
            'user_id' => auth()->user()->id,
            'thread_id' => $request->thread_id,
            'body' => $request->body,
            'file' => $file_name,
        ]);

        return redirect()->back()->with('success', 'Thread Replied');
    }

    public function update(Request $request, ReplyThread $reply_thread)
    {
        $request->validate([
            'body' => 'required|string',
            'file' => 'nullable|max:4999|file',
        ]);

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $file_name = 'REPLY_' . $request->title . '_' . time() . '.' . $extension;

            $request->file('file')->storeAs('public/forum', $file_name);
        } else {
            $file_name = $reply_thread->file;
        }

        $reply_thread->update([
            'body' => $request->body,
            'file' => $file_name,
        ]);

        return redirect()->back()->with('success', 'Reply Thread Updated');
    }

    public function destroy(ReplyThread $reply_thread)
    {
        $reply_thread->delete();
        return redirect()->back()->with('success', 'Reply thread deleted');
    }
}
