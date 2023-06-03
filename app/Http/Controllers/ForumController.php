<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use App\Models\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index($classSubjectId)
    {
        return view('forum.index', [
            'forums' => Forum::select('forum.forum_id', 'forum.user_id', 'forum.title', 'forum.class_subject_id')
                ->join('class_subject', 'forum.class_subject_id', 'class_subject.class_subject_id')
                ->where('class_subject.class_subject_id', $classSubjectId)->orderBy('class_subject_id', 'desc')->get(),
            'classSubject' => ClassSubject::select('class_subject.class_subject_id as id', 'class_subject.name as name',
                'class_header.name as className', 'school_year.year as schoolYear', 'school_year.semester as semester', 'user.name as teacherName',
                'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'user.user_code as teacherNuptk')
                ->join('class_header', 'class_header.class_header_id', 'class_subject.class_header_id')
                ->join('school_year', 'school_year.school_year_id', 'class_header.school_year_id')
                ->join('user', 'user.user_id', 'class_subject.user_id')
                ->join('user as userB', 'userB.user_id', 'class_header.user_id')
                ->find($classSubjectId)
        ]);
    }

    public function store(Request $request)
    {
        $this->validateData($request);

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $file_name = 'REPLY_' . $request->title . '_' . time() . '.' . $extension;

            $request->file('file')->storeAs('public/forum', $file_name);
        } else {
            $file_name = NULL;
        }

        Forum::create([
            'user_id' => auth()->user()->user_id,
            'class_subject_id' => $request->class_subject_id,
            'title' => $request->title,
            'description' => $request->description,
            'file' => $file_name
        ]);

        return redirect()->back()->with('success', 'New Forum Created');
    }

    public function show($forumId, $classSubjectId)
    {
        return view('forum.show', [
            'forum' => Forum::find($forumId),
            'classSubject' => ClassSubject::find($classSubjectId)
        ]);
    }

    public function update(Request $request, Forum $forum)
    {
        $this->validateData($request);

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $file_name = 'FORUM_' . $request->title . '_' . time() . '.' . $extension;

            $request->file('file')->storeAs('public/forum', $file_name);
        } else {
            $file_name = $forum->file;
        }

        $forum->update([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $file_name
        ]);

        return redirect()->back()->with('success', 'Forum Updated');
    }

    public function destroy($forum)
    {
        Forum::destroy($forum);
        return redirect()->back()->with('success', 'Forum Deleted');
    }

    public function validateData($request) {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'file' => 'nullable|max:4999|file'
        ]);
    }

    public function viewChooseClassSubject() {
        if (auth()->user()->role->name === 'Student') {
            return view('forum.index', [
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

            return view('forum.index',[
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
