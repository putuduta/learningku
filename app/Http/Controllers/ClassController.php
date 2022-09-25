<?php

namespace App\Http\Controllers;

use App\Models\ClassHeader;
use App\Models\RequestClass;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ClassController extends Controller
{
    public function viewListClass(){
        return view('class.list',[
            'classes' => ClassHeader::where('teacher_id', auth()->user()->id)->get(),
        ]);
    }

    public function viewCreateClass(){
        return view('class.create',[
            'teachers' => User::select('users.id','users.name')
                        ->where('users.role','Teacher')
                        ->get()
        ]);
    }

    public function createClass(Request $request){

        $request->validate([
            'class_name' => 'required|string',
            'class_description' => 'required|string'
        ]);

        ClassHeader::create([
            'guid' => bin2hex(random_bytes('16')),
            'name' => $request->class_name,
            'description' => $request->class_description,
            'teacher_id' => auth()->user()->id
        ]);

        return redirect()->route('class-view-list')->with('success','New Class Created');
    }

    public function viewClassStudent(ClassHeader $class){
        return view('class.student-list',[
            'students' => User::select('users.id','users.name')
                        ->join('class_details','class_details.student_id','users.id')
                        ->where([['users.role','Student'],['class_details.class_header_id',$class->id]])
                        ->get(),
            'class' => $class,
        ]);
    }

    public function viewJoinClass($guid){
        return view('request-class.index',[
            'classes' => ClassHeader::where('guid', $guid)->first(),
        ]);
    }
   
    public function requestClass(Request $request){
        
        RequestClass::create([
            'student_id' => auth()->user()->id,
            'class_id' => $request->class_id,
            'status' => 'New Request',
            'comment' => $request->comment
        ]);

        return redirect()->route('home')->with('success','Request Join Class');
    }

}
