<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Task;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;

class ShowController extends BaseController
{
    public function __invoke(Request $request, Course $course)
    {
        $search = $request->search;

        $user = User::find(auth()->user()->id);
        $courses = $user->coursesUser()->get();
        $themes = Theme::where('course_id', $course->id)->get();
        $tasks = Task::where('title', 'LIKE', "%{$search}%")->where('course_id', $course->id)->orderBy('id', 'desc')->get();

        return view('course.show', compact('courses', 'course', 'themes', 'tasks'));
    }
}
