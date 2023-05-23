<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use App\Models\Forum;
use App\Models\User;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index($classSubjectId)
    {
        return view('forum.index', [
            'forums' => Forum::select('forums.id', 'forums.teacher_user_id', 'forums.title', 'forums.class_subject_id')
                ->join('class_subjects', 'forums.class_subject_id', 'class_subjects.id')
                ->where('class_subjects.id', $classSubjectId)->orderBy('id', 'desc')->get(),
            'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name',
                'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName',
                'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'users.user_code as teacherNuptk')
                ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                ->join('users', 'users.id', 'class_subjects.teacher_user_id')
                ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_user_id')
                ->find($classSubjectId),
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
            'teacher_user_id' => auth()->user()->user_id,
            'class_subject_id' => $request->class_subject_id,
            'title' => $request->title,
            'description' => $request->description,
            'file' => $file_name,
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
            'file' => $file_name,
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
            'file' => 'nullable|max:4999|file',
        ]);
    }

    public function viewChooseClassSubject() {
        if (auth()->user()->role->name === 'Student') {
            return view('forum.index', [
                'classSubjects' => ClassSubject::select('class_headers.id as classId','class_headers.name','school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as homeroomTeacherName', 'class_headers.homeroom_teacher_user_id as homeroomTeacherId', 'users.user_code as homeRoomTeacherNuptk',
                                    'class_subjects.id as subjectId', 'class_subjects.name as subjectName','user2.id as teacherId', 'user2.name as teacherName', 'user2.user_code as teacherNuptk')
                                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')    
                                    ->join('school_years','school_years.id','class_headers.school_year_id')
                                    ->join('class_details', 'class_details.class_header_id', 'class_headers.id')
                                    ->join('users', 'users.id', 'class_headers.homeroom_teacher_user_id')
                                    ->join('users as user2', 'user2.id', 'class_subjects.teacher_user_id')
                                    ->join('roles','roles.id','users.role_id')
                                    ->where('roles.name','Teacher')
                                    ->where('class_details.student_user_id', auth()->user()->user_id)
                                    ->orderBy('class_headers.school_year_id', 'DESC')->get()
            ]);
        } else {

            return view('forum.index',[
                'classSubjects' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name', 'class_headers.name as className', 'class_headers.id as classId','users.id as teacherId', 'users.name as teacherName', 'users.user_code as teacherNuptk', 'userB.name as homeroomTeacherName', 'userB.user_code as homeroomTeacherNuptk', 'school_years.year as schoolYear', 'school_years.semester as semester', 'school_years.id as schoolYearId')
                                    ->join('users', 'users.id', 'class_subjects.teacher_user_id')
                                    ->join('roles','roles.id','users.role_id')
                                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                                    ->join('school_years','school_years.id','class_headers.school_year_id')
                                    ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_user_id')
                                    ->where('roles.name','Teacher')
                                    ->where('class_subjects.teacher_user_id', auth()->user()->user_id)
                                    ->orderBy('class_headers.school_year_id', 'DESC')->get()
            ]);
        }
    }
}
