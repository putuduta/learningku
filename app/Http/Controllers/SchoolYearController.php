<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use Illuminate\Http\Request;

class SchoolYearController extends Controller
{

    public function index(){
        return view('admin.school-year-list',[
            'schoolYearList' => SchoolYear::where('school', auth()->user()->school)->get()
        ]);
    }

    public function store(Request $request){

        $this->validateData($request);

        SchoolYear::create([
            'year' => $request->year,
            'semester' => $request->semester,
            'school' => $request->school
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
            'semester' => 'required|string',
            'school' => 'required|string'
        ]);
    }
}
