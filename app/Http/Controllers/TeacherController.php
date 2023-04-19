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
        $password = Hash::make("BHKLearningku");

        $request->validate([
            'name' => 'required|string',
            'nuptk' => 'required|string',
            'email' => 'required|email',
            'image' => 'image|max:5120',
            'gender' => 'required|string',
        ]);

        $photo_profile = null;
        if($request->image){
            $file = $request->file('image');
            $imageName = time().'_'.$file->getClientOriginalName();

            Storage::putFileAs('public/images', $file, $imageName);
            $imagePath = 'images/'.$imageName;
            $photo_profile = $imagePath;
        }


        $student = DB::table('users')->find(DB::table('users')->max('id'));
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'role_id' => $role->id,
            'user_code' => $request->nuptk,
            'password' => $password,
            'photo_profile' => $photo_profile 
        ]);

        return redirect()->back()->with('success','Success Add Teacher');
    }

    public function destroy($id){
        // dd($id);
        $teacher = User::find($id);
    	$teacher->delete();

        return redirect()->back()->with('success', 'Teacher Deleted');
    }


    public function update($id, Request $request){

        $request->validate([
            'name' => 'required|string',
            'user_code' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'image' => 'image|max:5120',
            'gender' => 'required|string'
        ]);

        $teacher = User::find($id);

        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->gender = $request->gender;
        $teacher->nuptk = $request->nuptk;

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
        
        $teacher->save();

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
            'teachers' => User::select('users.id','users.name','users.user_code as nuptk','users.email','users.password', 
                        'users.gender')
                        ->join('roles','roles.id','users.role_id')
                        ->where([['roles.name','Teacher']])
                        ->get()
        ]);
    }

    
}
