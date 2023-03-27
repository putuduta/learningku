<?php

namespace App\Http\Controllers;

use App\Models\ClassDetail;
use App\Models\ClassHeader;
use App\Models\ClassSubject;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ClassSubjectController extends Controller
{
    public function index(ClassHeader $class){

        $teacherInClass = Teacher::select('users.id as id')
            ->join('users', 'users.id', 'teachers.user_id')
            ->join('roles','roles.id','users.role_id')
            ->join('class_subjects', 'class_subjects.teacher_user_id', 'teachers.user_id')
            ->where('roles.name','Teacher')
            ->where('class_subjects.class_header_id', $class->id)->get()->toArray();

        return view('admin.class-subject-list',[
            'classSubjects' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name','class_subjects.description as description','users.id as teacherId', 'users.name as teacherName')
                ->join('teachers', 'teachers.user_id', 'class_subjects.teacher_user_id')
                ->join('users', 'users.id', 'teachers.user_id')
                ->join('roles','roles.id','users.role_id')
                ->where('roles.name','Teacher')
                ->where('class_subjects.class_header_id', $class->id)
                ->get(),
            'class' => $class,
            'teachersNotAssigned' => Teacher::select('users.id as id', 'users.name as name', 'teachers.nuptk as nuptk')
                ->join('users', 'users.id', 'teachers.user_id')
                ->join('roles','roles.id','users.role_id')
                ->where('roles.name','Teacher')
                ->whereNotIn('users.id', $teacherInClass)
            ->get(),
            'schoolYear' => SchoolYear::where('id', $class->school_year_id)->first()
        ]);
    }


    public function store($classId, Request $request){

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        ClassSubject::create([
            'name' => $request->name,
            'description' => $request->description,
            'class_header_id' => $classId,
            'teacher_user_id' => $request->teacher_id
        ]);

        return redirect()->back()->with('success','Success Add Subject and Teacher to Class');
    }

    public function update($id, Request $request){

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        $subject = ClassSubject::find($id);

        $subject->name = $request->name;
        $subject->description = $request->description;
        $subject->class_header_id = $request->class_id;
        $subject->teacher_user_id = $request->teacher_id;
        
        $subject->save();

        return redirect()->back()->with('success', 'Subject Updated');
    }

    public function destroy($id){
        $deleteSubject = ClassSubject::find($id);
        $deleteSubject->delete();

        return redirect()->back()->with('success', 'Subject Deleted');
    }
}
