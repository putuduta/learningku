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
            'classes' => ClassHeader::select('class_headers.id','class_headers.name','school_year.school_year_id as schoolYearId','school_year.year as year', 'school_year.semester as semester', 'user.name as homeroomTeacherName', 'class_headers.user_id as homeroomTeacherId'
                       , 'user.user_code as teacherNuptk')
                ->join('school_year','school_year.school_year_id','class_headers.school_year_id')
                ->join('user', 'user.user_id', 'class_headers.user_id')
                ->where('class_headers.school_year_id', $request->school_year_id)
                ->get(),
            'teachers' => User::select('user.user_id as id', 'user.name as name', 'user.user_code as teacherNuptk')
                ->join('role','role.role_id','user.role_id')
                ->leftJoin('class_headers', 'class_headers.user_id', 'user.user_id')
                ->where('role.name','Teacher')
                ->whereNull('class_headers.user_id')
                ->get()
        ]);
    }

    public function viewAdminClassList($schoolYearId){
        return view('admin.class-list',[
            'classes' => ClassHeader::select('class_headers.id','class_headers.name','school_year.school_year_id as schoolYearId','school_year.year as year', 'school_year.semester as semester', 'user.name as homeroomTeacherName', 'class_headers.user_id as homeroomTeacherId'
                       , 'user.user_code as teacherNuptk')
                ->join('school_year','school_year.school_year_id','class_headers.school_year_id')
                ->join('user', 'user.user_id', 'class_headers.user_id')
                ->where('class_headers.school_year_id', $schoolYearId)
                ->get(),
            'teachers' => User::select('user.user_id as id', 'user.name as name', 'user.user_code as teacherNuptk')
                ->join('role','role.role_id','user.role_id')
                ->leftJoin('class_headers', 'class_headers.user_id', 'user.user_id')
                ->where('role.name','Teacher')
                ->whereNull('class_headers.user_id')
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
