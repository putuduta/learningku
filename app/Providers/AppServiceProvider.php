<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\ServiceProvider;

use App\Models\ClassDetail;
use App\Models\ClassHeader;
use App\Models\RequestClass;
use Illuminate\Http\Request;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('components.sidebar', function ($view) {
            if (auth()->user()->role->name == 'Student') {

                $classes = ClassHeader::select('class_headers.id','class_headers.name','school_year.year as schoolYear', 'school_year.semester as semester')
                ->join('school_year','school_year.school_year_id','class_headers.school_year_id')
                ->join('class_details', 'class_details.class_header_id', 'class_headers.id')
                ->join('users', 'users.id', 'class_details.student_user_id')
                ->where('users.id', auth()->user()->id)
                ->get();

                $student = User::select('users.id','users.name','users.user_code as nisn','users.email','users.password', 
                'users.gender')
                ->join('role','role.role_id','users.role_id')
                ->where('users.id',  auth()->user()->id)
                ->first();

                $view->with(compact('classes', 'student'));
            } else if (auth()->user()->role->name == 'Teacher') {
                $view->with('teacher', User::select('users.id','users.name','users.user_code  as nuptk','users.email','users.password', 
                'users.gender')
                ->join('role','role.role_id','users.role_id')
                ->where('users.id',  auth()->user()->id)
                ->first());
            }
        });
    }
}
