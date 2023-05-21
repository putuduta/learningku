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

    public function index(){
        return view('admin.school-year-list',[
            'schoolYearList' => SchoolYear::get()
        ]);
    }

    public function store(Request $request){

        $this->validateData($request);

        SchoolYear::create([
            'year' => $request->year,
            'semester' => $request->semester,
        ]);

        return redirect()->route('admin-school-year-view')->with('success','New School Year Created');
    }

    public function update(SchoolYear $schoolYear, Request $request){
        $this->validateData($request);

        $schoolYear->update([
            'year' => $request->year,
            'semester' => $request->semester,
        ]);

        return redirect()->back()->with('success', 'School Year Updated');
    }
    
    public function destroy($id)
    {
        SchoolYear::destroy($id);

        return redirect()->back()->with('success', 'School Year deleted');
    }

    public function validateData($request) 
    {
        $request->validate([
            'year' => 'required|string',
            'semester' => 'required|string'
        ]);
    }
}
