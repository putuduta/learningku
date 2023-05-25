<?php

namespace App\Http\Controllers;


use App\Models\ClassSubject;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function index($classSubjectId){
        return view('material.index', [
            'classSubject' => ClassSubject::select('class_subject.class_subject_id as id', 'class_subject.name as name',
                'class_header.name as className', 'school_year.year as schoolYear', 'school_year.semester as semester', 'user.name as teacherName',
                'userB.name as homeRoomTeacherName', 'userB.user_code as homeRoomTeacherNuptk', 'user.user_code as teacherNuptk')
                ->join('class_header', 'class_header.class_header_id', 'class_subject.class_header_id')
                ->join('school_year', 'school_year.school_year_id', 'class_header.school_year_id')
                ->join('user', 'user.user_id', 'class_subject.user_id')
                ->join('user as userB', 'userB.user_id', 'class_header.user_id')
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
                'classSubjects' => ClassSubject::select('class_header.class_header_id as classId','class_header.name','school_year.year as schoolYear', 'school_year.semester as semester', 'user.name as homeroomTeacherName', 'class_header.user_id as homeroomTeacherId', 'user.user_code as homeRoomTeacherNuptk',
                                    'class_subject.class_subject_id as subjectId', 'class_subject.name as subjectName','user2.user_id as teacherId', 'user2.name as teacherName', 'user2.user_code as teacherNuptk')
                                    ->join('class_header', 'class_header.class_header_id', 'class_subject.class_header_id')    
                                    ->join('school_year','school_year.school_year_id','class_header.school_year_id')
                                    ->join('class_details', 'class_details.class_header_id', 'class_header.class_header_id')
                                    ->join('user', 'user.user_id', 'class_header.user_id')
                                    ->join('user as user2', 'user2.user_id', 'class_subject.user_id')
                                    ->join('role','role.role_id','user.role_id')
                                    ->where('role.name','Teacher')
                                    ->where('class_details.user_id', auth()->user()->user_id)
                                    ->orderBy('class_header.school_year_id', 'DESC')->get()
            ]);
        } else {

            return view('material.index',[
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
