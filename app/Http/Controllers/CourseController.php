<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Course;
use Inertia\Inertia;

class CourseController extends Controller
{
    public function show(Course $course)
    {
        $course->load(['lessons' => function ($query) {
            $query->orderBy('sort_order');
        }, 'quiz']);

        return Inertia::render('Course/Show', [
            'course' => $course,
            'completedLessonIds' => auth()->user()->completedLessons()->where('course_id', $course->id)->pluck('lessons.id'),
            'latestAttempt' => auth()->user()->quizAttempts()->where('quiz_id', $course->quiz?->id)->latest()->first(),
        ]);
    }
}
