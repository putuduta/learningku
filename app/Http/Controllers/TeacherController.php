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
        $this->validateData($request, false);

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
            'role_id' => 2,
            'user_code' => $request->nuptk,
            'password' => $request->password,
            'photo_profile' => $photo_profile 
        ]);

        return redirect()->back()->with('success','Success Add Teacher');
    }

    public function destroy($id){
        User::destroy($id);

        return redirect()->back()->with('success', 'Teacher Deleted');
    }


    public function update(User $teacher, Request $request){

        $this->validateData($request, true);

        $password = $teacher->password;
        if(Hash::check($request->password,  $password)){
            $password = Hash::make($request->password);
        }

        if($request->image){
            $file = $request->file('image');
            $imageName = time().'_'.$file->getClientOriginalName();

            Storage::putFileAs('public/images', $file, $imageName);
            $imagePath = 'images/'.$imageName;
        } else {
            $imagePath = $teacher->imagePath;
        }
        
        $teacher->update([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'user_code' => $request->nuptk,
            'password' => $password,
            'photo_profile' => $imagePath 
        ]);

        return redirect()->back()->with('success', 'Teacher Data Updated');
    }

    public function index(){
        return view('admin.teacher-list',[
            'teacherList' => User::select('users.id','users.name','users.user_code as nuptk','users.email','users.password', 
                        'users.gender')
                        ->join('roles','roles.id','users.role_id')
                        ->where([['roles.name','Teacher']])
                        ->get()
        ]);
    }

    public function validateData($request, $isUpdate) {
        $request->validate([
            'name' => 'required|string',
            'nuptk' => 'required|string',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'image' => 'image|max:5120',
            'gender' => 'required|string'
        ]);

        if (!$isUpdate) {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'alpha_num']
            ]);
        }
    }
    
}
