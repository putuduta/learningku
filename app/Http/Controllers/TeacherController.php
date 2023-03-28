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

class TeacherController extends Controller
{

    public function store(Request $request){
        
        $role = Role::where('name', 'Teacher')->first();

        $request->validate([
            'name' => 'required|string',
            'nuptk' => 'required|string',
            'email' => 'required|email',
            'image' => 'image|max:5120',
            'gender' => 'required|string',
            'position' => 'required|string',
            'last_education' => 'required|string',
            'subject_taught' => 'required|string'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->role_id = $role->id;
        $user->password = Hash::make("BHKLearningku");

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
            'last_education' => $request->last_education,
            'position' => $request->position,
            'subject_taught' => $request->subject_taught,
        ]);

        return redirect()->back()->with('success','Success Add Teacher');
    }

    public function destroy($id){
        // dd($id);
        DB::table('teachers')->where('user_id', $id)->delete();

        return redirect()->back()->with('success', 'Teacher Deleted');
    }


    public function update($id, Request $request){

        $request->validate([
            'name' => 'required|string',
            'nuptk' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'image' => 'image|max:5120',
            'gender' => 'required|string',
            'position' => 'required|string',
            'last_education' => 'required|string',
            'subject_taught' => 'required|string'
        ]);

        $teacher = User::find($id);

        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->gender = $request->gender;

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
        $teacherDetail->position = $request->position;
        $teacherDetail->last_education = $request->last_education;
        $teacherDetail->subject_taught = $request->subject_taught;
        
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
            'teachers' => User::select('users.id','users.name','teachers.nuptk','users.email','users.password', 
                        'users.gender', 'teachers.last_education', 'teachers.position', 'teachers.subject_taught')
                        ->join('roles','roles.id','users.role_id')
                        ->join('teachers','teachers.user_id','users.id')
                        ->where([['roles.name','Teacher']])
                        ->get()
        ]);
    }

    
}
