<?php

namespace App\Http\Controllers;

use App\Models\ClassDetail;
use App\Models\ClassHeader;
use App\Models\ClassSubject;
use App\Models\Forum;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SchoolYearController extends Controller
{

    // School Year
    public function index(){
        return view('admin.school-year-list',[
            'schoolYears' => SchoolYear::get()
        ]);
    }

    public function store(Request $request){

        $request->validate([
            'year' => 'required|string',
            'semester' => 'required|string'
        ]);

        SchoolYear::create([
            'year' => $request->year,
            'semester' => $request->semester,
        ]);

        return redirect()->route('admin-school-year-view')->with('success','New School Year Created');
    }

    public function update($id, Request $request){
        $schoolYear = SchoolYear::find($id);

        $schoolYear->year = $request->year;
        $schoolYear->semester = $request->semester;
        
        $schoolYear->save();

        return redirect()->back()->with('success', 'School Year Updated');
    }
    
    public function destroy($id)
    {
        $schoolYear = SchoolYear::find($id);
        $schoolYear->delete();

        return redirect()->back()->with('success', 'School Year deleted');
    }
}
