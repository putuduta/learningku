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
                $view->with('classes', ClassHeader::select('class_headers.id','class_headers.name','school_years.year as schoolYear', 'school_years.semester as semester')
                ->join('school_years','school_years.id','class_headers.school_year_id')
                ->join('class_details', 'class_details.class_header_id', 'class_headers.id')
                ->join('students', 'students.user_id', 'class_details.student_user_id')
                ->where('students.user_id', auth()->user()->id)
                ->get());
            }
        });
    }
}
