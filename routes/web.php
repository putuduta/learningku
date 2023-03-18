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
use App\Http\Controllers\MaterialController;

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
Route::get('/dashboard/class/{classId}', [DashboardController::class, 'viewClassDashboard'])->name('dashboard-class')->middleware('auth');

//Material
Route::prefix('material')->middleware('auth')->name('material.')->group(function () {
    Route::get('/student-material/{classSubjectId}', [MaterialController::class, 'viewMaterialStudent'])->name('view-student');
    Route::get('/teacher-material/{classSubjectId}', [MaterialController::class, 'viewMaterialTeacher'])->name('view-teacher');
    Route::post('/teacher-material', [MaterialController::class, 'store'])->name('create');
    Route::delete('/delete-material/{material}', [MaterialController::class, 'destroy'])->name('delete');
    Route::put('/update-material/{id}', [MaterialController::class, 'update'])->name('update');
    Route::get('/download-material/{id}', [MaterialController::class, 'download'])->name('download');
});

Route::prefix('admin/school-year')->middleware('auth')->name('admin-school-year-')->group(function () {
    Route::get('/view', [AdminController::class, 'viewSchoolYear'])->name('view');
    Route::post('/create', [AdminController::class, 'createSchoolYear'])->name('create');
    Route::put('/update/{id}', [AdminController::class, 'updateSchoolYear'])->name('update');
});

Route::prefix('admin/class')->middleware('auth')->name('admin-class-')->group(function () {
    Route::get('/choose-school-year', [AdminController::class, 'viewChooseSchoolYear'])->name('view-choose-school-year');
    Route::post('/choose-school-year', [AdminController::class, 'postChooseSchoolYear'])->name('post-choose-school-year');
    Route::get('/view/{schoolYearId}', [AdminController::class, 'viewClassList'])->name('view');
    Route::post('/create/{schoolYearId}', [AdminController::class, 'createClass'])->name('create');
    Route::put('/update/{id}', [AdminController::class, 'updateClass'])->name('update');
    
    Route::get('/student/{class}', [AdminController::class, 'viewClassStudent'])->name('view-student');
    Route::post('/assign-student/{class}', [AdminController::class, 'assignStudentToClass'])->name('assign-student');
    Route::get('/remove-student/{student}', [AdminController::class, 'removeStudentFromClass'])->name('remove-student');

    Route::get('/subject/{class}', [AdminController::class, 'viewClassSubject'])->name('view-subject');
    Route::post('/assign-subject/{class}', [AdminController::class, 'assignSubjectToClass'])->name('assign-subject');
    Route::post('/update-subject/{class}', [AdminController::class, 'updateSubject'])->name('update-subject');
    Route::get('/remove-subject/{subject}', [AdminController::class, 'removeSubject'])->name('remove-subject');
});

// Class
Route::prefix('class')->middleware('auth')->name('class-')->group(function () {
    Route::get('list', [ClassController::class, 'viewListClass'])->name('view-list');
    // Route::get('create', [ClassController::class, 'viewCreateClass'])->name('view-create');
    // Route::get('create/post', [ClassController::class, 'createClass'])->name('create');
    Route::get('student/{class}', [ClassController::class, 'viewClassStudent'])->name('view-student');
    Route::get('request-join/{guid}', [ClassController::class, 'viewJoinClass'])->name('view-join');
    Route::post('create-request-join/post', [ClassController::class, 'requestClass'])->name('request-join');
    Route::get('request-joins', [ClassController::class, 'listRequestClass'])->name('list-request-join');
    Route::get('request-action/{classRequestId}/{action}', [ClassController::class, 'requestClassAction'])->name('request-action');
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
    Route::get('list/teacher/{classSubjectId}', [AttendanceController::class, 'viewTeacherList'])->name('view-teacher-list');
    Route::get('list/student/{classSubjectId}', [AttendanceController::class, 'viewStudentList'])->name('view-student-list');
    Route::get('create/{classSubjectId}', [AttendanceController::class, 'viewCreate'])->name('view-create');
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
Route::get('thread/{classSubjectId}', [ThreadController::class, 'index'])->name('thread.index');
Route::get('thread-show/{threadId}/{classSubjectId}', [ThreadController::class, 'show'])->name('thread.show');
Route::resource('thread', ThreadController::class)->except('edit', 'create', 'index', 'show');
Route::resource('reply-thread', ReplyThreadController::class)->only('store', 'update', 'destroy');

// Assignment
Route::get('assignment/{classSubjectId}', [AssignmentController::class, 'index'])->name('assignment.index');
Route::get('assignment-show/{assignmentId}/{classSubjectId}', [AssignmentController::class, 'show'])->name('assignment.showDetails');
Route::resource('assignment', AssignmentController::class)->only('store');
Route::post('assignment/submit/{assignmentHeader}', [AssignmentController::class, 'submit'])->name('assignment.submit');
Route::get('assignment/{assignmentHeader}', [AssignmentController::class, 'show'])->name('assignment.show');

// Score
Route::get('score/{classId}', [ScoreController::class, 'index'])->name('score.index');
Route::get('score/manage/{classId}', [ScoreController::class, 'manage'])->name('score.manage');
// Route::get('score/detail/{student}', [ScoreController::class, 'detail'])->name('score.detail');
Route::get('score/detail/{classId}/{student}', [ScoreController::class, 'detail'])->name('score.detail');
Route::get('score/edit/{classId}/{score}', [ScoreController::class, 'change'])->name('score.change');
Route::resource('score', ScoreController::class)->except('create', 'index');
Route::get('score/create/{classCourseId}/{userId}', [ScoreController::class, 'create'])->name('score.create');
