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
        if (auth()->user()->role->name == 'Student') {
            return view('material.index', [
                'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name',
                    'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName',
                    'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'users.user_code as teacherNuptk')
                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                    ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                    ->join('users', 'users.id', 'class_subjects.teacher_user_id')
                    ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_user_id')
                    ->where('class_subjects.id', $classSubjectId)->first(),
                'materials' => Material::where('class_subject_id', $classSubjectId)->get()
            ]);
        } else {
            return view('material.index', [
                'classSubject' => ClassSubject::select('class_subjects.id as id', 'class_subjects.name as name',
                    'class_headers.name as className', 'school_years.year as schoolYear', 'school_years.semester as semester', 'users.name as teacherName',
                    'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'users.user_code as teacherNuptk')
                    ->join('class_headers', 'class_headers.id', 'class_subjects.class_header_id')
                    ->join('school_years', 'school_years.id', 'class_headers.school_year_id')
                    ->join('users', 'users.id', 'class_subjects.teacher_user_id')
                    ->join('users as userB', 'userB.id', 'class_headers.homeroom_teacher_user_id')
                    ->where('class_subjects.id', $classSubjectId)->first(),
                'materials' => Material::where('class_subject_id', $classSubjectId)->get()
            ]);
        }
    }

    public function create(){

    }

    public function store(Request $request){   
        $material = new Material();

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $file_name = 'Material_' . $request->title . '_' . time() . '.' . $extension;
            $image = $request->file('file')->storeAs('public/material', $file_name);
        } else {
            $image = "";
        }

        $material->class_subject_id = $request->class_subject_id;
        $material->title = $request->title;
        $material->description = $request->description;
        $material->resource = $image;

        $material->save();

        return redirect()->back()->with('success', 'New Material Created');
    }

    public function show($id){

    }

    public function edit($id){

    }

    public function update(Request $request){
        $updateMaterial = Material::find($request->id);
        
        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $file_name = 'Material_' . $request->title . '_' . time() . '.' . $extension;
            $image = $request->file('file')->storeAs('public/material', $file_name);
        } else {
            $image = $updateMaterial->resource;
        }

        $updateMaterial->class_subject_id = $request->class_subject_id;
        $updateMaterial->title = $request->title;
        $updateMaterial->description = $request->description;
        $updateMaterial->resource = $image;
        
        $updateMaterial->save();

        return redirect()->back()->with('success', 'Material Updated');
    }

    public function destroy($id){
        $deleteMaterial = Material::find($id);
        $deleteMaterial->delete();
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
}
