<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function enroll(Course $course)
    {
        $user = auth()->user();
        
        if (!$user->courses()->where('course_id', $course->id)->exists()) {
            $user->courses()->attach($course->id);
        }
        
        return back()->with('success', 'Successfully enrolled in ' . $course->title);
    }

    public function unenroll(Course $course)
    {
        $user = auth()->user();
        $user->courses()->detach($course->id);
        
        return back()->with('success', 'Successfully unenrolled from ' . $course->title);
    }
}
