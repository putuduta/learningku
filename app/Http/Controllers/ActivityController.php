<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ClassCourse;
use Illuminate\Http\Request;
use PDO;

class ActivityController extends Controller
{
    public function viewTeacherList()
    {
        return view('activity.teacher_list', [
            'activites' => Activity::select('activities.id', 'activities.class_course_id', 'activities.description', 'activities.date')
                ->join('class_courses', 'activities.class_course_id', 'class_courses.id')
                ->where('teacher_id', auth()->user()->id)->orderBy('id', 'desc')->get(),
        ]);
    }

    public function viewStudentList()
    {
        return view('activity.student_list', [
            'activites' => Activity::select('activities.id', 'activities.class_course_id', 'activities.description', 'activities.date')
                ->join('class_courses', 'activities.class_course_id', 'class_courses.id')
                ->where('class_id', auth()->user()->class_id)->orderBy('id', 'desc')->get(),
        ]);
    }

    public function viewCreate()
    {
        return view('activity.create', [
            'class_courses' => ClassCourse::where('teacher_id', auth()->user()->id)->get(),
        ]);
    }

    public function create()
    {

        request()->validate([
            'date' => 'required',
            'description' => 'required',
        ]);

        Activity::create([
            'date' => request('date'),
            'class_course_id' => request('class_course_id'),
            'description' => request('description'),
        ]);

        return redirect()->route('activity.view-teacher-list')->with('success', 'New Activity Created');
    }

    public function delete(Activity $activity)
    {
        $activity->delete();
        return redirect()->back()->with('success', 'Activity Deleted');
    }
}
