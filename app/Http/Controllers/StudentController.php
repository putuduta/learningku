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

class StudentController extends Controller
{
    public function store(Request $request){
        
        $request->validate([
            'name' => 'required|string',
            'nisn' => 'required|string',
            'email' => 'required|email',
            'image' => 'image|max:5120'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = '3';
        $user->password = Hash::make(Str::random(8));

        if($request->image){
            $file = $request->file('image');
            $imageName = time().'_'.$file->getClientOriginalName();

            Storage::putFileAs('public/images', $file, $imageName);
            $imagePath = 'images/'.$imageName;
            $user->photo_profile = $imagePath;
        }

        $user->save();

        $student = DB::table('users')->find(DB::table('users')->max('id'));
        
        Student::create([
            'user_id' => $student->id,
            'nisn' => $request->nisn,
        ]);

        return redirect()->back()->with('success','Success to Add Student');
    }


    public function destroy($id){
        DB::table('students')->where('user_id', $id)->delete();

        return redirect()->back()->with('success', 'Student Deleted');
    }

    public function update($id, Request $request){

        $request->validate([
            'name' => 'required|string',
            'nisn' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'image' => 'image|max:5120'
        ]);

        $student = User::find($id);

        $student->name = $request->name;
        $student->email = $request->email;

        if(Hash::check($request->password, $student->password)){
            $student->password = Hash::make($request->password);
        }

        if($request->image){
            $file = $request->file('image');
            $imageName = time().'_'.$file->getClientOriginalName();

            Storage::putFileAs('public/images', $file, $imageName);
            $imagePath = 'images/'.$imageName;
            $student->photo_profile = $imagePath;
        }

        $studentDetail = Student::find($id);
        $studentDetail->nisn = $request->nisn;
        
        $student->save();
        $studentDetail->save();

        return redirect()->back()->with('success', 'Student Data Updated');
    }

    public function index(){
        return view('admin.student-list',[
            'students' => User::select('users.id','users.name','students.nisn','users.email','users.password')
                        ->join('roles','roles.id','users.role_id')
                        ->join('students','students.user_id','users.id')
                        ->where([['roles.name','Student']])
                        ->get()
        ]);
    }
}
