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
use App\Models\ClassSubject;
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
    Route::get('/view', [SchoolYearController::class, 'index'])->name('view')->middleware('auth');
    Route::post('/create', [SchoolYearController::class, 'store'])->name('create')->middleware('auth');
    Route::put('/update/{schoolYear}', [SchoolYearController::class, 'update'])->name('update')->middleware('auth');
    Route::delete('/remove/{id}', [SchoolYearController::class, 'destroy'])->name('remove')->middleware('auth');
});

// Admin Manage Class, Class Details, Class Subject
Route::prefix('admin/class')->middleware('auth')->name('admin-class-')->group(function () {
    Route::get('choose-school-year', [ClassHeaderController::class, 'viewChooseSchoolYear'])->name('view-choose-school-year')->middleware('auth');
    Route::post('choose-school-year', [ClassHeaderController::class, 'postChooseSchoolYear'])->name('post-choose-school-year')->middleware('auth');
    Route::get('view/{schoolYearId}', [ClassHeaderController::class, 'viewAdminClassList'])->name('view')->middleware('auth');
    Route::post('create/{schoolYearId}', [ClassHeaderController::class, 'store'])->name('create')->middleware('auth');
    Route::put('update/{class}', [ClassHeaderController::class, 'update'])->name('update')->middleware('auth');
    Route::delete('remove/{id}', [ClassHeaderController::class, 'destroy'])->name('remove')->middleware('auth');
    
    Route::get('student/{class}', [ClassDetailController::class, 'viewClassDetailsAdmin'])->name('view-student')->middleware('auth');
    Route::post('assign-student', [ClassDetailController::class, 'assignStudentToClass'])->name('assign-student')->middleware('auth');
    Route::delete('remove-student/{student}', [ClassDetailController::class, 'removeStudentFromClass'])->name('remove-student')->middleware('auth');

    Route::get('subject/{class}', [ClassSubjectController::class, 'index'])->name('view-subject')->middleware('auth');
    Route::post('assign-subject/{class}', [ClassSubjectController::class, 'store'])->name('assign-subject')->middleware('auth');
    Route::put('update-subject/{classSubject}', [ClassSubjectController::class, 'update'])->name('update-subject')->middleware('auth');
    Route::delete('remove-subject/{subject}', [ClassSubjectController::class, 'destroy'])->name('remove-subject')->middleware('auth');
});

// Admin Manage Teacher
Route::prefix('admin/teacher')->middleware('auth')->name('admin-teacher-')->group(function () {
    Route::get('list', [TeacherController::class, 'index'])->name('view-list')->middleware('auth');
    Route::post('add', [TeacherController::class, 'store'])->name('add')->middleware('auth');
    Route::put('update/{teacher}', [TeacherController::class, 'update'])->name('update')->middleware('auth');
    Route::delete('remove/{teacher}', [TeacherController::class, 'destroy'])->name('remove')->middleware('auth');
});

// Admin Manage Student
Route::prefix('admin/student')->middleware('auth')->name('student-')->group(function () {
    Route::get('list', [StudentController::class, 'index'])->name('view-list')->middleware('auth');
    Route::post('add', [StudentController::class, 'store'])->name('add')->middleware('auth');
    Route::delete('/remove/{student}', [StudentController::class, 'destroy'])->name('remove')->middleware('auth');
    Route::put('/update/{student}', [StudentController::class, 'update'])->name('update')->middleware('auth');
});

// Teacher & Student 

// Class
Route::get('/dashboard/class-subject', [ClassSubjectController::class, 'viewClassAndSubject'])->name('dashboard-class')->middleware('auth');

Route::prefix('class')->middleware('auth')->name('class-')->group(function () {
    Route::get('teacher-get-list/{schoolYearId}', [ClassHeaderController::class, 'getTeacherClassTaught'])->name('get-list')->middleware('auth');
    Route::get('student-get-list/{classId}', [ClassHeaderController::class, 'getStudentClass'])->name('get-list')->middleware('auth');
});


Route::get('student-choose-class', [ClassDetailController::class, 'viewChooseClass'])->name('class-view-student-choose-class')->middleware('auth');
Route::get('student/{classSubjectId}', [ClassDetailController::class, 'viewClassDetails'])->name('class-view-student')->middleware('auth');

//Material
Route::prefix('material')->middleware('auth')->name('material.')->group(function () {
    Route::get('-choose-class-subject', [MaterialController::class, 'viewChooseClassSubject'])->name('view-choose-class-subject')->middleware('auth');
    Route::get('/{classSubjectId}', [MaterialController::class, 'index'])->name('index')->middleware('auth');
    Route::post('store', [MaterialController::class, 'store'])->name('create')->middleware('auth');
    Route::delete('destroy/{material}', [MaterialController::class, 'destroy'])->name('delete')->middleware('auth');
    Route::put('update/{material}', [MaterialController::class, 'update'])->name('update')->middleware('auth');
    Route::get('download/{id}', [MaterialController::class, 'download'])->name('download')->middleware('auth');
});

// Attendance
Route::prefix('attendance')->middleware('auth')->name('attendance.')->group(function () {
    Route::get('-choose-class-subject', [AttendanceController::class, 'viewChooseClassSubject'])->name('view-choose-class-subject')->middleware('auth');
    Route::get('/teacher/{classSubjectId}', [AttendanceController::class, 'viewAttendanceTeacher'])->name('view-teacher')->middleware('auth');
    Route::get('/student/{classSubjectId}', [AttendanceController::class, 'viewAttendanceStudent'])->name('view-student')->middleware('auth');
    Route::get('create/{classSubjectId}', [AttendanceController::class, 'viewCreate'])->name('view-create')->middleware('auth');
    Route::post('create/post', [AttendanceController::class, 'create'])->name('create')->middleware('auth');
});

// Forum
Route::get('forum/{classSubjectId}', [ForumController::class, 'index'])->name('forum.index')->middleware('auth');
Route::get('forum-choose-class-subject', [ForumController::class, 'viewChooseClassSubject'])->name('forum.view-choose-class-subject')->middleware('auth');
Route::get('forum-show/{forumId}/{classSubjectId}', [ForumController::class, 'show'])->name('forum.show')->middleware('auth');
Route::resource('forum', ForumController::class)->except('edit', 'create', 'index', 'show')->middleware('auth');
Route::resource('reply-forum', ReplyForumController::class)->only('store', 'update', 'destroy')->middleware('auth');

// Assignment
Route::get('assignment/{classSubjectId}', [AssignmentHeaderController::class, 'index'])->name('assignment.index')->middleware('auth');
Route::get('assignment-choose-class-subject', [AssignmentHeaderController::class, 'viewChooseClassSubject'])->name('assignment.view-choose-class-subject')->middleware('auth');
Route::get('assignment-show/{assignmentId}', [AssignmentHeaderController::class, 'viewAssignmentSubmission'])->name('assignment.showDetails')->middleware('auth');
// Route::resource('assignment', AssignmentController::class)->only('store');
Route::post('assignment/{classSubjectId}', [AssignmentHeaderController::class, 'store'])->name('assignment.add')->middleware('auth');
Route::put('assignment/update/{assignment}', [AssignmentHeaderController::class, 'update'])->name('assignment.update')->middleware('auth');
Route::post('assignment/submit', [AssignmentDetailController::class, 'submitAssignmentAnswer'])->name('assignment.submit')->middleware('auth');
// Route::get('assignment/{assignmentHeader}', [AssignmentController::class, 'show'])->name('assignment.show');

// Score
Route::get('score/student/{classId}', [ScoreController::class, 'indexStudent'])->name('score.index-student')->middleware('auth');
Route::get('score/teacher/{classId}', [ScoreController::class, 'indexTeacher'])->name('score.index-teacher')->middleware('auth');
Route::get('score/show/{studentId}/{classSubjectId}', [ScoreController::class, 'show'])->name('score.show')->middleware('auth');
// Route::get('score/detail/{student}', [ScoreController::class, 'detail'])->name('score.detail');
Route::post('score/store/assignment-score/{score}', [ScoreController::class, 'storeAssignmentScore'])->name('score.store-assignment')->middleware('auth');
Route::put('score/update/assignment-score/{score}', [ScoreController::class, 'updateAssignmentScore'])->name('score.update-assignment')->middleware('auth');
Route::post('score/store/exam-score', [ScoreController::class, 'storeExamScore'])->name('score.store-exam')->middleware('auth');
Route::put('score/update/exam-score/{score}', [ScoreController::class, 'updateExamScore'])->name('score.update-exam')->middleware('auth');
Route::resource('score', ScoreController::class)->except('create', 'index', 'show')->middleware('auth');
Route::get('score/create/{classCourseId}/{userId}', [ScoreController::class, 'create'])->name('score.create')->middleware('auth');
Route::get('score-choose-class-subject', [ScoreController::class, 'viewChooseClassSubject'])->name('score.view-choose-class-subject')->middleware('auth');

