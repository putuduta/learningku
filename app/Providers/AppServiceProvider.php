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
            if (auth()->user()->role == 'Teacher') {
                $view->with('classes', ClassHeader::select('class_headers.id as classId', 'class_headers.name as className')
                ->where('class_headers.teacher_id',auth()->user()->id)
                ->get());
            }

            if (auth()->user()->role == 'Student') {
                $view->with('classes', ClassHeader::select('class_headers.id as classId', 'class_headers.name as className')
                ->join('class_details','class_headers.id','class_details.class_header_id')
                ->where('class_details.student_id',auth()->user()->id)
                ->get());
            }
        });
    }
}
