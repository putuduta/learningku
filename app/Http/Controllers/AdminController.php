<?php

namespace App\Http\Controllers;

use App\Models\ClassDetail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function viewListClass(){
        return view('admin.class-list',[
            'classes' => ClassDetail::where('institution_id', auth()->user()->institution_id)->get(),
        ]);
    }

    public function viewCreateClass(){
        return view('admin.class-create',[
            'teachers' => User::select('users.id','users.name')
                        ->join('roles','roles.id','users.role_id')
                        ->where('roles.name','Teacher')
                        ->get()
        ]);
    }

    public function createClass(Request $request){

        $request->validate([
            'class_name' => 'required|string'
        ]);

        ClassDetail::create([
            'name' => $request->class_name,
            'institution_id' => auth()->user()->institution_id,
            'homeroom_id' => $request->homeroom_id,
        ]);

        return redirect()->route('class-view-list')->with('success','New Class Created');
    }

    public function viewClassStudent(ClassDetail $class){
        return view('admin.class-student-list',[
            'students' => User::select('users.id','users.name')
                        ->join('roles','roles.id','users.role_id')
                        ->where([['roles.name','Student'],['class_id',$class->id]])
                        ->get(),
            'class' => $class,
        ]);
    }

    public function viewListStudent(){
        return view('admin.student-list',[
            'students' => User::select('users.id','users.name')
                        ->join('roles','roles.id','users.role_id')
                        ->where([['roles.name','Student'],['institution_id',auth()->user()->institution_id]])
                        ->get()
        ]);
    }

    public function viewCreateStudent(){
        return view('admin.student-create',[
            'classes' => ClassDetail::where('institution_id',auth()->user()->institution_id)->get()
        ]);
    }

    public function createStudent(Request $request){
        
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'reg_number' => 'required|numeric',
            'phone_number' => 'required|numeric',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'reg_number' => $request->reg_number,
            'phone_number' => $request->phone_number,
            'role_id' => 3,
            'institution_id' => auth()->user()->institution->id,
            'class_id' => $request->class_id,
            'password' => Hash::make('abcd')
        ]);

        return redirect()->route('student-view-list')->with('success','New Student Created');
    }

    public function viewListTeacher(){
        return view('admin.teacher-list',[
            'teachers' => User::select('users.id','users.name')
                        ->join('roles','roles.id','users.role_id')
                        ->where([['roles.name','Teacher'],['institution_id',auth()->user()->institution_id]])
                        ->get()
        ]);
    }

    public function viewCreateTeacher(){
        return view('admin.teacher-create');
    }

    public function createTeacher(Request $request){
        
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'reg_number' => 'required|numeric',
            'phone_number' => 'required|numeric',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'reg_number' => $request->reg_number,
            'phone_number' => $request->phone_number,
            'role_id' => 2,
            'institution_id' => auth()->user()->institution->id,
            'password' => Hash::make('abcd')
        ]);

        return redirect()->route('teacher-view-list')->with('success','New Teacher Created');
    }

    
}
