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

class TeacherController extends Controller
{

    public function store(Request $request){
        
        $request->validate([
            'name' => 'required|string',
            'nuptk' => 'required|string',
            'email' => 'required|email',
            'image' => 'image|max:5120'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = '2';
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
        
        Teacher::create([
            'user_id' => $student->id,
            'nuptk' => $request->nuptk,
        ]);

        return redirect()->back()->with('success','Success to Add Teacher');
    }

    public function destroy($id){
        $deleteStudent = User::find($id);
        $deleteStudent->delete();

        return redirect()->back()->with('success', 'Teacher Deleted');
    }


    public function update($id, Request $request){

        $request->validate([
            'name' => 'required|string',
            'nuptk' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'image' => 'image|max:5120'
        ]);

        $teacher = User::find($id);

        $teacher->name = $request->name;
        $teacher->email = $request->email;

        if(Hash::check($request->password, $teacher->password)){
            $teacher->password = Hash::make($request->password);
        }
        
        if($request->image){
            $file = $request->file('image');
            $imageName = time().'_'.$file->getClientOriginalName();

            Storage::putFileAs('public/images', $file, $imageName);
            $imagePath = 'images/'.$imageName;
            $teacher->photo_profile = $imagePath;
        }

        $teacherDetail = Teacher::find($id);
        $teacherDetail->nuptk = $request->nuptk;
        
        $teacher->save();
        $teacherDetail->save();

        return redirect()->back()->with('success', 'Teacher Data Updated');
    }

    public function index(){
        /*return view('admin.teacher-list',[
            'teachers' => User::select('users.id','users.name')
                        ->join('roles','roles.id','users.role_id')
                        ->where([['roles.name','Teacher'],['institution_id',auth()->user()->institution_id]])
                        ->get()
        ]);*/

        return view('admin.teacher-list',[
            'teachers' => User::select('users.id','users.name','teachers.nuptk','users.email','users.password')
                        ->join('roles','roles.id','users.role_id')
                        ->join('teachers','teachers.user_id','users.id')
                        ->where([['roles.name','Teacher']])
                        ->get()
        ]);
    }

    
}
