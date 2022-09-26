<?php

namespace App\Http\Controllers;

use App\Models\ClassDetail;
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

    public function listRequestClass(){
        
        if (auth()->user()->role == 'Teacher') {
            return view('request-class.list',[
                'requestClasses' => RequestClass::select('request_classes.id','request_classes.status','request_classes.comment', 'users.id as studentId', 'users.name as studentName', 'users.role', 'class_headers.id as classId', 'class_headers.name as className')
                ->join('class_headers','class_headers.id','request_classes.class_id')
                ->join('users','users.id','request_classes.student_id')
                ->where('class_headers.teacher_id',auth()->user()->id)
                ->get(),
            ]);
        }else if (auth()->user()->role == 'Student') {
            return view('request-class.list',[
                'requestClasses' => RequestClass::where('student_id', auth()->user()->id)->get(),
            ]);
        } else 
             return redirect()->route('home');
    }

    public function requestClassAction($classRequestId, $action){
        
        $requestClass = RequestClass::where('id', $classRequestId)->first();
        $message = '';

        if ($action == 'Approve')  {
            ClassDetail::create([
                'class_header_id' => $requestClass->class_id,
                'student_id' => $requestClass->student_id,
            ]);
            $message = 'Approve Request Class';
        } else {
            $message = 'Reject Request Class';
        }

        $requestClass->update([
            'status' => $action
        ]);

        return redirect()->route('home')->with('success', $message);
    }

}
