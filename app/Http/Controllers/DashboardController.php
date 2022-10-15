<?php

namespace App\Http\Controllers;

use App\Models\ClassDetail;
use App\Models\ClassHeader;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function view(){
        return view('dashboard.index');
    }

    public function viewClassDashboard($classId) {
        return view('dashboard.class', [
            'class' => ClassHeader::where('id', $classId)
            ->first()
        ]);
    }
}
