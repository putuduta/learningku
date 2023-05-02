<?php

namespace App\Http\Controllers;

use App\Models\ClassDetail;
use App\Models\ClassHeader;
use App\Models\ClassSubject;
use App\Models\Role;
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
        
        $role = Role::where('name', 'Student')->first();

        $request->validate([
            'name' => 'required|string',
            'nisn' => 'required|string',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'image' => 'image|max:5120',
            'gender' => 'required|string',
            'password' => ['required', 'string', 'min:8', 'alpha_num']
        ]);

        $photo_profile = null;
        if($request->image){
            $file = $request->file('image');
            $imageName = time().'_'.$file->getClientOriginalName();

            Storage::putFileAs('public/images', $file, $imageName);
            $imagePath = 'images/'.$imageName;
            $photo_profile = $imagePath;
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'role_id' => $role->id,
            'password' => Hash::make("BHKLearningku"),
            'user_code' => $request->nisn,
            'photo_profile' => $photo_profile
        ]);

        return redirect()->back()->with('success','Success to Add Student');
    }


    public function destroy($id){
        $student = User::find($id);
    	$student->delete();

        return redirect()->back()->with('success', 'Student Deleted');
    }

    public function update($id, Request $request){

        $request->validate([
            'name' => 'required|string',
            'nisn' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'image' => 'image|max:5120',
            'gender' => 'required|string',
        ]);

        $student = User::find($id);

        $student->name = $request->name;
        $student->email = $request->email;
        $student->gender = $request->gender;
        $student->user_code = $request->nisn;

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
        
        $student->save();

        return redirect()->back()->with('success', 'Student Data Updated');
    }

    public function index(){
        return view('admin.student-list',[
            'students' => User::select('users.id','users.name','users.user_code as nisn','users.email','users.password', 'users.gender')
                        ->join('roles','roles.id','users.role_id')
                        ->where([['roles.name','Student']])
                        ->get()
        ]);
    }
}
