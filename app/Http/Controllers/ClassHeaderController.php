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
            'schoolYears' => SchoolYear::where('school', auth()->user()->school)->get()
        ]);
    }

    // Class
    public function postChooseSchoolYear(Request $request){
        return view('admin.class-list',[
            'classes' => ClassHeader::select('class_header.class_header_id','class_header.name','school_year.school_year_id as schoolYearId','school_year.year as year', 'school_year.semester as semester', 'user.name as homeroomTeacherName', 'class_header.user_id as homeroomTeacherId'
                        , 'user.user_code as teacherNuptk')
                        ->join('user', 'user.user_id', 'class_header.user_id')
                        ->rightJoin('school_year','school_year.school_year_id','class_header.school_year_id')
                        ->where('school_year.school_year_id', $request->school_year_id)
                        ->get(),
            'teachers' => User::select('user.user_id as id', 'user.name as name', 'user.user_code as teacherNuptk')
                        ->join('role','role.role_id','user.role_id')
                        ->leftJoin('class_header', 'class_header.user_id', 'user.user_id')
                        ->leftJoin('school_year','school_year.school_year_id','class_header.school_year_id')
                        ->where([['role.name','Teacher'], ['school_year.school_year_id', '!=', $request->school_year_id]])
                        ->get()
        ]);
    }

    public function viewAdminClassList($schoolYearId){
        return view('admin.class-list',[
            'classes' => ClassHeader::select('class_header.class_header_id','class_header.name','school_year.school_year_id as schoolYearId','school_year.year as year', 'school_year.semester as semester', 'user.name as homeroomTeacherName', 'class_header.user_id as homeroomTeacherId'
                        , 'user.user_code as teacherNuptk')
                        ->join('user', 'user.user_id', 'class_header.user_id')
                        ->rightJoin('school_year','school_year.school_year_id','class_header.school_year_id')
                        ->where('school_year.school_year_id', $schoolYearId)
                        ->get(),
            'teachers' => User::select('user.user_id as id', 'user.name as name', 'user.user_code as teacherNuptk')
                        ->join('role','role.role_id','user.role_id')
                        ->leftJoin('class_header', 'class_header.user_id', 'user.user_id')
                        ->leftJoin('school_year','school_year.school_year_id','class_header.school_year_id')
                        ->where([['role.name','Teacher'], ['school_year.school_year_id', '!=', $schoolYearId]])
                        ->get()
        ]);
    }

    public function store($schoolYearId, Request $request){

        $this->validateData($request);

        ClassHeader::create([
            'name' => $request->class_name,
            'school_year_id' => $schoolYearId,
            'user_id' => $request->homeroom_teacher_user_id,
        ]);

        return redirect()->back()->with('success','New Class Created');
    }

    public function update(Request $request){
        $this->validateData($request);

        ClassHeader::where('class_header_id', $request->class_header_id)->update([
            'name' => $request->class_name,
            'school_year_id' => $request->school_year_id,
            'user_id' => $request->homeroom_teacher_user_id,
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
