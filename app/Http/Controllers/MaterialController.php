<?php

namespace App\Http\Controllers;

use App\Models\ClassDetail;
use App\Models\ClassHeader;
use App\Models\ClassSubject;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function index($classSubjectId){
        return view('material.index', [
            'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name',
                'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName',
                'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'users.user_code as teacherNuptk')
                ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                ->join('users', 'users.id', 'class_subjects.teacher_user_id')
                ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_user_id')
                ->find($classSubjectId),
            'materials' => Material::where('class_subject_id', $classSubjectId)->get()
        ]);
    }


    public function store(Request $request){   
        $this->validateData($request);

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $file_name = 'Material_' . $request->title . '_' . time() . '.' . $extension;
            $image = $request->file('file')->storeAs('public/material', $file_name);
        } else {
            $file_name = "";
        }

        Material::create([
            'class_subject_id' => $request->class_subject_id,
            'title' => $request->title,
            'description' => $request->description,
            'resource' => $file_name,
        ]);

        return redirect()->back()->with('success', 'New Material Created');
    }

    public function update(Material $material, Request $request){

        $this->validateData($request);

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $file_name = 'Material_' . $request->title . '_' . time() . '.' . $extension;
            $image = $request->file('file')->storeAs('public/material', $file_name);
        } else {
            $file_name = $material->resource;
        }

        $material->update([
            'class_subject_id' => $request->class_subject_id,
            'title' => $request->title,
            'description' => $request->description,
            'resource' => $file_name,
        ]);

        return redirect()->back()->with('success', 'Material Updated');
    }

    public function destroy($id){
        Material::destroy($id);

        return redirect()->back()->with('success', 'Material Deleted');
    }
    
    public function download($id){
        $downloadMaterial = Material::find($id);
        $fileLoc = substr($downloadMaterial->resource, 7);

        if(Storage::disk('public')->exists($fileLoc)){
            $path = Storage::disk('public')->path($fileLoc);
            $content = file_get_contents($path);
            return response($content)->withHeaders([
                'Content-type' => mime_content_type($path)
            ]);
        }else{
            return redirect('/404');
        }

        //return response()->download(storage_path('app\material\Material_BAB 1_1674658639.txt'));
    }

    public function validateData($request) {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string'
        ]);
    }

    public function viewChooseClassSubject() {
        if (auth()->user()->role->name === 'Student') {
            return view('material.index', [
                'classSubjects' => ClassSubject::select('class_headers.id as classId','class_headers.name','school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as homeroomTeacherName', 'class_headers.homeroom_teacher_user_id as homeroomTeacherId', 'users.user_code as homeRoomTeacherNuptk',
                                    'class_subjects.id as subjectId', 'class_subjects.name as subjectName','user2.id as teacherId', 'user2.name as teacherName', 'user2.user_code as teacherNuptk')
                                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')    
                                    ->join('school_years','school_years.id','class_headers.school_year_id')
                                    ->join('class_details', 'class_details.class_header_id', 'class_headers.id')
                                    ->join('users', 'users.id', 'class_headers.homeroom_teacher_user_id')
                                    ->join('users as user2', 'user2.id', 'class_subjects.teacher_user_id')
                                    ->join('roles','roles.id','users.role_id')
                                    ->where('roles.name','Teacher')
                                    ->where('class_details.student_user_id', auth()->user()->id)
                                    ->orderBy('class_headers.school_year_id', 'DESC')->get()
            ]);
        } else {

            return view('material.index',[
                'classSubjects' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name', 'class_headers.name as className', 'class_headers.id as classId','users.id as teacherId', 'users.name as teacherName', 'users.user_code as teacherNuptk', 'userB.name as homeroomTeacherName', 'userB.user_code as homeroomTeacherNuptk', 'school_years.year as schoolYear', 'school_years.semester as semester', 'school_years.id as schoolYearId')
                                    ->join('users', 'users.id', 'class_subjects.teacher_user_id')
                                    ->join('roles','roles.id','users.role_id')
                                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                                    ->join('school_years','school_years.id','class_headers.school_year_id')
                                    ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_user_id')
                                    ->where('roles.name','Teacher')
                                    ->where('class_subjects.teacher_user_id', auth()->user()->id)
                                    ->orderBy('class_headers.school_year_id', 'DESC')->get()
            ]);
        }
    }
}
