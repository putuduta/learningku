<?php

namespace App\Http\Controllers;

use App\Models\ClassHeader;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\User;

class ClassHeaderController extends Controller
{

    public function viewChooseSchoolYear(){
        return view('admin.choose-school-year',[
            'schoolYears' => SchoolYear::get()
        ]);
    }

    // Class
    public function postChooseSchoolYear(Request $request){
        return view('admin.class-list',[
            'classes' => ClassHeader::select('class_headers.id','class_headers.name','school_years.id as schoolYearId','school_years.year as year', 'school_years.semester as semester', 'users.name as homeroomTeacherName', 'class_headers.homeroom_teacher_user_id as homeroomTeacherId'
                       , 'users.user_code as teacherNuptk')
                ->join('school_years','school_years.id','class_headers.school_year_id')
                ->join('users', 'users.id', 'class_headers.homeroom_teacher_user_id')
                ->where('class_headers.school_year_id', $request->school_year_id)
                ->get(),
            'teachers' => User::select('users.id as id', 'users.name as name', 'users.user_code as teacherNuptk')
                ->join('roles','roles.id','users.role_id')
                ->leftJoin('class_headers', 'class_headers.homeroom_teacher_user_id', 'users.id')
                ->where('roles.name','Teacher')
                ->whereNull('class_headers.homeroom_teacher_user_id')
                ->get()
        ]);
    }

    public function viewAdminClassList($schoolYearId){
        return view('admin.class-list',[
            'classes' => ClassHeader::select('class_headers.id','class_headers.name','school_years.id as schoolYearId','school_years.year as year', 'school_years.semester as semester', 'users.name as homeroomTeacherName', 'class_headers.homeroom_teacher_user_id as homeroomTeacherId'
                       , 'users.user_code as teacherNuptk')
                ->join('school_years','school_years.id','class_headers.school_year_id')
                ->join('users', 'users.id', 'class_headers.homeroom_teacher_user_id')
                ->where('class_headers.school_year_id', $schoolYearId)
                ->get(),
            'teachers' => User::select('users.id as id', 'users.name as name', 'users.user_code as teacherNuptk')
                ->join('roles','roles.id','users.role_id')
                ->leftJoin('class_headers', 'class_headers.homeroom_teacher_user_id', 'users.id')
                ->where('roles.name','Teacher')
                ->whereNull('class_headers.homeroom_teacher_user_id')
                ->get()
        ]);
    }

    public function store($schoolYearId, Request $request){

        $this->validateData($request);

        ClassHeader::create([
            'name' => $request->class_name,
            'school_year_id' => $schoolYearId,
            'homeroom_teacher_user_id' => $request->homeroom_teacher_user_id,
        ]);

        return redirect()->back()->with('success','New Class Created');
    }

    public function update(ClassHeader $class, Request $request){
        $this->validateData($request);

        $class->update([
            'name' => $request->class_name,
            'school_year_id' => $request->school_year_id,
            'homeroom_teacher_user_id' => $request->homeroom_teacher_user_id,
        ]);

        return redirect()->back()->with('success', 'Class Updated');
    }    

    public function destroy($id)
    {
        ClassHeader::destroy($id);
        return redirect()->back()->with('success', 'Class deleted');
    }

    public function validateData($request) {
        $request->validate([
            'class_name' => 'required|string'
        ]);
    }
}
