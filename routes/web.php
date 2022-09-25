<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ReplyThreadController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistrationPaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ClassCourseController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\ClassController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'view'])->name('dashboard')->middleware('auth');

// // Registration Payment
// Route::prefix('payment')->name('payment-')->group(function () {
//     Route::get('/list', [RegistrationPaymentController::class, 'viewList'])->name('view-list');
//     Route::post('/create', [RegistrationPaymentController::class, 'validateData'])->name('validate');
//     Route::post('/create/post', [RegistrationPaymentController::class, 'create'])->name('create');
//     Route::get('/confirm/{payment}', [RegistrationPaymentController::class, 'confirm'])->name('confirm')->middleware('auth');
//     Route::get('/reject/{payment}', [RegistrationPaymentController::class, 'reject'])->name('reject')->middleware('auth');
// });


// Class
Route::prefix('class')->middleware('auth')->name('class-')->group(function () {
    Route::get('list', [ClassController::class, 'viewListClass'])->name('view-list');
    Route::get('create', [ClassController::class, 'viewCreateClass'])->name('view-create');
    Route::get('create/post', [ClassController::class, 'createClass'])->name('create');
    Route::get('student/{class}', [ClassController::class, 'viewClassStudent'])->name('view-student');
    Route::get('request-join/{guid}', [ClassController::class, 'viewJoinClass'])->name('view-join');
    Route::post('create-request-join/post', [ClassController::class, 'requestClass'])->name('request-join');
});

Route::prefix('student')->middleware('auth')->name('student-')->group(function () {
    Route::get('list', [AdminController::class, 'viewListStudent'])->name('view-list');
    Route::get('create', [AdminController::class, 'viewCreateStudent'])->name('view-create');
    Route::get('create/post', [AdminController::class, 'createStudent'])->name('create');
});

Route::prefix('teacher')->middleware('auth')->name('teacher-')->group(function () {
    Route::get('list', [AdminController::class, 'viewListTeacher'])->name('view-list');
    Route::get('create', [AdminController::class, 'viewCreateTeacher'])->name('view-create');
    Route::get('create/post', [AdminController::class, 'createTeacher'])->name('create');
});

Route::prefix('attendance')->middleware('auth')->name('attendance.')->group(function () {
    Route::get('list/teacher', [AttendanceController::class, 'viewTeacherList'])->name('view-teacher-list');
    Route::get('list/student', [AttendanceController::class, 'viewStudentList'])->name('view-student-list');
    Route::get('create', [AttendanceController::class, 'viewCreate'])->name('view-create');
    Route::post('create/post', [AttendanceController::class, 'create'])->name('create');
});

Route::prefix('activity')->middleware('auth')->name('activity.')->group(function () {
    Route::get('list/teacher', [ActivityController::class, 'viewTeacherList'])->name('view-teacher-list');
    Route::get('list/student', [ActivityController::class, 'viewStudentList'])->name('view-student-list');
    Route::get('create', [ActivityController::class, 'viewCreate'])->name('view-create');
    Route::post('create/post', [ActivityController::class, 'create'])->name('create');
    Route::get('delete/{activity}', [ActivityController::class, 'delete'])->name('delete');
});

Route::prefix('class-course')->middleware('auth')->name('class-course.')->group(function () {
    Route::get('list', [ClassCourseController::class, 'viewList'])->name('view-list');
    Route::get('schedule/student', [ClassCourseController::class, 'viewStudent'])->name('view-student');
    Route::get('schedule/teacher', [ClassCourseController::class, 'viewTeacher'])->name('view-teacher');
    Route::get('create', [ClassCourseController::class, 'viewCreate'])->name('view-create');
    Route::post('create/post', [ClassCourseController::class, 'create'])->name('create');
    Route::get('delete/{class_course}', [ClassCourseController::class, 'delete'])->name('delete');
});

// Forum Thread
Route::resource('thread', ThreadController::class)->except('edit', 'create');
Route::resource('reply-thread', ReplyThreadController::class)->only('store', 'update', 'destroy');

// Assignment
Route::resource('assignment', AssignmentController::class)->only('index', 'store');
Route::post('assignment/submit/{assignmentHeader}', [AssignmentController::class, 'submit'])->name('assignment.submit');
Route::get('assignment/{assignmentHeader}', [AssignmentController::class, 'show'])->name('assignment.show');

// Score
Route::resource('score', ScoreController::class)->except('create');
Route::get('score/create/{classCourseId}/{userId}', [ScoreController::class, 'create'])->name('score.create');
Route::get('score/manage/{id}', [ScoreController::class, 'manage'])->name('score.manage');
