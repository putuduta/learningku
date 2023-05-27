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

                $classes = ClassHeader::select('class_header.class_header_id','class_header.name','school_year.year as schoolYear', 'school_year.semester as semester')
                ->join('school_year','school_year.school_year_id','class_header.school_year_id')
                ->join('class_detail', 'class_detail.class_header_id', 'class_header.class_header_id')
                ->join('user', 'user.user_id', 'class_detail.user_id')
                ->where('user.user_id', auth()->user()->user_id)
                ->get();

                $student = User::select('user.user_id','user.name','user.user_code as nisn','user.email','user.password', 
                'user.gender')
                ->join('role','role.role_id','user.role_id')
                ->where('user.user_id',  auth()->user()->user_id)
                ->first();

                $view->with(compact('classes', 'student'));
            } else if (auth()->user()->role->name == 'Teacher') {
                $view->with('teacher', User::select('user.user_id','user.name','user.user_code as nuptk','user.email','user.password', 
                'user.gender')
                ->join('role','role.role_id','user.role_id')
                ->where('user.user_id',  auth()->user()->user_id)
                ->first());
            }
        });
    }
}
