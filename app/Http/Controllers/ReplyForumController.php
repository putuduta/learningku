<?php

namespace App\Http\Controllers;

use App\Models\ReplyForum;
use Illuminate\Http\Request;

class ReplyForumController extends Controller
{

    public function store(Request $request)
    {
        $this->validateData($request);
        
        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $file_name = 'REPLY_' . $request->forum_id . '_' . time() . '.' . $extension;

            $request->file('file')->storeAs('public/forum', $file_name);
        } else {
            $file_name = NULL;
        }

        ReplyForum::create([
            'user_id' => auth()->user()->user_id,
            'forum_id' => $request->forum_id,
            'description' => $request->description,
            'file' => $file_name,
        ]);

        return redirect()->back()->with('success', 'Forum Replied');
    }

    public function update(Request $request, ReplyForum $reply_forum)
    {
        $this->validateData($request);

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $file_name = 'REPLY_' . $request->title . '_' . time() . '.' . $extension;

            $request->file('file')->storeAs('public/forum', $file_name);
        } else {
            $file_name = $reply_forum->file;
        }

        $reply_forum->update([
            'description' => $request->description,
            'file' => $file_name,
        ]);

        return redirect()->back()->with('success', 'Reply Forum Updated');
    }

    public function destroy($reply_forum)
    {
        ReplyForum::destroy($reply_forum->id);
        return redirect()->back()->with('success', 'Reply forum deleted');
    }

    public function validateData($request) {
        $request->validate([
            'description' => 'required|string',
            'file' => 'nullable|max:4999|file'
        ]);
    }
}
