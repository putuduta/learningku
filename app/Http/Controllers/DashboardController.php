<?php

namespace App\Http\Controllers;

use App\Models\ClassDetail;
use App\Models\ClassHeader;
use App\Models\ClassSubject;
use App\Models\Material;
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
}