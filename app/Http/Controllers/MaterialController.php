<?php

namespace App\Http\Controllers;

use App\Models\ClassDetail;
use App\Models\ClassHeader;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function viewMaterialStudent($classId){
        return view('material.index', [
            'class' => ClassHeader::where('id', $classId)->first(),
            'materials' => Material::where('class_id', $classId)->get()
        ]);
    }

    public function viewMaterialTeacher($classId){
        return view('material.index', [
            'class' => ClassHeader::where('id', $classId)->first(),
            'materials' => Material::where('class_id', $classId)->get()
        ]);
    }

    public function index(){

    }

    public function create(){

    }

    public function store(Request $request){   
        $material = new Material();

        $material->class_id = $request->class_id;
        $material->title = $request->title;
        $material->description = $request->description;
        $material->resource = $request->resource;

        $material->save();

        return redirect()->back()->with('success', 'New Material Created');
    }

    public function show($id){

    }

    public function edit($id){

    }

    public function update(Request $request){
        $updateMaterial = Material::find($request->id);
        
        $updateMaterial->class_id = $request->class_id;
        $updateMaterial->title = $request->title;
        $updateMaterial->description = $request->title;
        $updateMaterial->resource = $request->title;
        dd($updateMaterial);
        
        return redirect()->back()->with('success', 'Reply Thread Updated');
    }

    public function destroy($id){
        $deleteMaterial = Material::find($id);
        $deleteMaterial->delete();
        return redirect()->back()->with('success', 'Material Deleted');
    }
    
}
