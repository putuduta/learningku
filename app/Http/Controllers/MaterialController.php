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
    public function viewMaterialStudent($classSubjectId){
        return view('material.index', [
            'classSubject' => ClassSubject::where('id', $classSubjectId)->first(),
            'materials' => Material::where('class_subject_id', $classSubjectId)->get()
        ]);
    }

    public function viewMaterialTeacher($classSubjectId){
        return view('material.index', [
            'classSubject' => ClassSubject::where('id', $classSubjectId)->first(),
            'materials' => Material::where('class_id', $classSubjectId)->get()
        ]);
    }

    public function index(){

    }

    public function create(){

    }

    public function store(Request $request){   
        $material = new Material();

        $extension = $request->file('file')->getClientOriginalExtension();
        $file_name = 'Material_' . $request->title . '_' . time() . '.' . $extension;
        $image = $request->file('file')->storeAs('public/material', $file_name);

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
