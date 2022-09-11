<?php

namespace App\Http\Controllers;

use App\Models\ClassCourse;
use App\Models\ClassDetail;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class ClassCourseController extends Controller
{
    public function viewList()
    {
        return view('class-course.list', [
            'class_courses' => ClassCourse::all(),
        ]);
    }

    public function viewCreate()
    {
        return view('class-course.create', [
            'courses' => Course::all(),
            'teachers' => User::select('users.id', 'users.name')
                ->join('roles', 'users.role_id', 'roles.id')->where([['users.institution_id', auth()->user()->institution_id], ['roles.name', 'Teacher']])->get(),
            'classes' => ClassDetail::where('institution_id', auth()->user()->institution_id)->get(),
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'course_id' => 'required',
            'teacher_id' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        ClassCourse::create([
            'class_id' => $request->class_id,
            'course_id' => $request->course_id,
            'teacher_id' => $request->teacher_id,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('class-course.view-list')->with('success', 'Class Course created');
    }

    public function delete(ClassCourse $class_course)
    {
        $class_course->delete();
        return redirect()->back()->with('success', 'Class Course Deleted');
    }

    public function getArrayDay()
    {
        return array(
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
            'sunday',
        );
    }

    public function viewStudent()
    {
        return view('class-course.schedule', [
            'monday_courses' =>  ClassCourse::where([['class_id', auth()->user()->class_id], ['day', 'MON']])->orderBy('start_time')->get(),
            'tuesday_courses' =>  ClassCourse::where([['class_id', auth()->user()->class_id], ['day', 'TUE']])->orderBy('start_time')->get(),
            'wednesday_courses' =>  ClassCourse::where([['class_id', auth()->user()->class_id], ['day', 'WED']])->orderBy('start_time')->get(),
            'thursday_courses' =>  ClassCourse::where([['class_id', auth()->user()->class_id], ['day', 'THU']])->orderBy('start_time')->get(),
            'friday_courses' =>  ClassCourse::where([['class_id', auth()->user()->class_id], ['day', 'FRI']])->orderBy('start_time')->get(),
            'saturday_courses' =>  ClassCourse::where([['class_id', auth()->user()->class_id], ['day', 'SAT']])->orderBy('start_time')->get(),
            'sunday_courses' =>  ClassCourse::where([['class_id', auth()->user()->class_id], ['day', 'SUN']])->orderBy('start_time')->get(),
            'days' => $this->getArrayDay()
        ]);
    }

    public function viewTeacher()
    {
        return view('class-course.schedule', [
            'monday_courses' =>  ClassCourse::where([['teacher_id', auth()->user()->id], ['day', 'MON']])->orderBy('start_time')->get(),
            'tuesday_courses' =>  ClassCourse::where([['teacher_id', auth()->user()->id], ['day', 'TUE']])->orderBy('start_time')->get(),
            'wednesday_courses' =>  ClassCourse::where([['teacher_id', auth()->user()->id], ['day', 'WED']])->orderBy('start_time')->get(),
            'thursday_courses' =>  ClassCourse::where([['teacher_id', auth()->user()->id], ['day', 'THU']])->orderBy('start_time')->get(),
            'friday_courses' =>  ClassCourse::where([['teacher_id', auth()->user()->id], ['day', 'FRI']])->orderBy('start_time')->get(),
            'saturday_courses' =>  ClassCourse::where([['teacher_id', auth()->user()->id], ['day', 'SAT']])->orderBy('start_time')->get(),
            'sunday_courses' =>  ClassCourse::where([['teacher_id', auth()->user()->id], ['day', 'SUN']])->orderBy('start_time')->get(),
            'days' => $this->getArrayDay()
        ]);
    }
}
