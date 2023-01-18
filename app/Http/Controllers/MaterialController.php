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
            'materials' => Material::where('class_id', $classId)->first()
        ]);
        
    }
}
