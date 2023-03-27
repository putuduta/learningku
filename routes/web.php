<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ReplyThreadController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AssignmentDetailController;
use App\Http\Controllers\AssignmentHeaderController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassDetailController;
use App\Http\Controllers\ClassHeaderController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ReplyForumController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Models\SchoolYear;

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

// Admin 
// Admin Manage - School Year
Route::prefix('admin/school-year')->middleware('auth')->name('admin-school-year-')->group(function () {
    Route::get('/view', [SchoolYearController::class, 'index'])->name('view');
    Route::post('/create', [SchoolYearController::class, 'store'])->name('create');
    Route::put('/update/{id}', [SchoolYearController::class, 'update'])->name('update');
    Route::get('/remove/{id}', [SchoolYearController::class, 'destroy'])->name('remove');
});

// Admin Manage Class, Class Details, Class Subject
Route::prefix('admin/class')->middleware('auth')->name('admin-class-')->group(function () {
    Route::get('choose-school-year', [ClassHeaderController::class, 'viewChooseSchoolYear'])->name('view-choose-school-year');
    Route::post('choose-school-year', [ClassHeaderController::class, 'postChooseSchoolYear'])->name('post-choose-school-year');
    Route::get('view/{schoolYearId}', [ClassHeaderController::class, 'viewAdminClassList'])->name('view');
    Route::post('create/{schoolYearId}', [ClassHeaderController::class, 'store'])->name('create');
    Route::put('update/{id}', [ClassHeaderController::class, 'update'])->name('update');
    Route::get('remove/{id}', [ClassHeaderController::class, 'destroy'])->name('remove');
    
    Route::get('student/{class}', [ClassDetailController::class, 'viewClassDetails'])->name('view-student');
    Route::post('assign-student/{class}', [ClassDetailController::class, 'assignStudentToClass'])->name('assign-student');
    Route::get('remove-student/{student}', [ClassDetailController::class, 'removeStudentFromClass'])->name('remove-student');

    Route::get('subject/{class}', [ClassSubjectController::class, 'index'])->name('view-subject');
    Route::post('assign-subject/{class}', [ClassSubjectController::class, 'store'])->name('assign-subject');
    Route::put('update-subject/{class}', [ClassSubjectController::class, 'update'])->name('update-subject');
    Route::get('remove-subject/{subject}', [ClassSubjectController::class, 'destroy'])->name('remove-subject');
});

// Admin Manage Teacher
Route::prefix('admin/teacher')->middleware('auth')->name('admin-teacher-')->group(function () {
    Route::get('list', [TeacherController::class, 'index'])->name('view-list');
    Route::post('add', [TeacherController::class, 'store'])->name('add');
    Route::put('update/{teacher}', [TeacherController::class, 'update'])->name('update');
    Route::get('remove/{teacher}', [TeacherController::class, 'destroy'])->name('remove');
});

// Admin Manage Student
Route::prefix('admin/student')->middleware('auth')->name('student-')->group(function () {
    Route::get('list', [StudentController::class, 'index'])->name('view-list');
    Route::post('add', [StudentController::class, 'store'])->name('add');
    Route::get('/remove/{student}', [StudentController::class, 'destroy'])->name('remove');
    Route::put('/update/{student}', [StudentController::class, 'update'])->name('update');
});

// Teacher & Student 

// Class
Route::get('/dashboard/class-student/{classId}', [ClassHeaderController::class, 'viewClassStudentDashboard'])->name('dashboard-class-student')->middleware('auth');
Route::get('/dashboard/class-teacher', [ClassHeaderController::class, 'viewClassTeacherDashboard'])->name('dashboard-class-teacher')->middleware('auth');

Route::prefix('class')->middleware('auth')->name('class-')->group(function () {
    Route::get('get-list/{schoolYearId}', [ClassHeaderController::class, 'getTeacherClassTaught'])->name('get-list');
    Route::get('student/{classSubjectId}', [ClassDetailController::class, 'viewClassDetails'])->name('view-student');
});

//Material
Route::prefix('material')->middleware('auth')->name('material.')->group(function () {
    Route::get('index/{classSubjectId}', [MaterialController::class, 'index'])->name('index');
    Route::post('store', [MaterialController::class, 'store'])->name('create');
    Route::delete('destroy/{material}', [MaterialController::class, 'destroy'])->name('delete');
    Route::put('update/{id}', [MaterialController::class, 'update'])->name('update');
    Route::get('download/{id}', [MaterialController::class, 'download'])->name('download');
});

// Attendance
Route::prefix('attendance')->middleware('auth')->name('attendance.')->group(function () {
    Route::get('index/{classSubjectId}', [AttendanceController::class, 'viewAttendance'])->name('view');
    Route::get('create/{classSubjectId}', [AttendanceController::class, 'viewCreate'])->name('view-create');
    Route::post('create/post', [AttendanceController::class, 'create'])->name('create');
});

// Forum
Route::get('forum/{classSubjectId}', [ForumController::class, 'index'])->name('forum.index');
Route::get('forum-show/{forumId}/{classSubjectId}', [ForumController::class, 'show'])->name('forum.show');
Route::resource('forum', ForumController::class)->except('edit', 'create', 'index', 'show');
Route::resource('reply-forum', ReplyForumController::class)->only('store', 'update', 'destroy');

// Assignment
Route::get('assignment/{classSubjectId}', [AssignmentHeaderController::class, 'index'])->name('assignment.index');
Route::get('assignment-show/{assignmentId}/{classSubjectId}', [AssignmentDetailController::class, 'viewAssignmentSubmission'])->name('assignment.showDetails');
// Route::resource('assignment', AssignmentController::class)->only('store');
Route::post('assignment/{classSubjectId}', [AssignmentHeaderController::class, 'store'])->name('assignment.add');
Route::post('assignment/submit/{assignmentHeader}', [AssignmentDetailController::class, 'submitAssignmentAnswer'])->name('assignment.submit');
// Route::get('assignment/{assignmentHeader}', [AssignmentController::class, 'show'])->name('assignment.show');

// Score
Route::get('score/{classId}', [ScoreController::class, 'index'])->name('score.index');
Route::get('score/manage/{classId}', [ScoreController::class, 'manage'])->name('score.manage');
// Route::get('score/detail/{student}', [ScoreController::class, 'detail'])->name('score.detail');
Route::get('score/detail/{classId}/{student}', [ScoreController::class, 'detail'])->name('score.detail');
Route::get('score/edit/{classId}/{score}', [ScoreController::class, 'change'])->name('score.change');
Route::resource('score', ScoreController::class)->except('create', 'index');
Route::get('score/create/{classCourseId}/{userId}', [ScoreController::class, 'create'])->name('score.create');
