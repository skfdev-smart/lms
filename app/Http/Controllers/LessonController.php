<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lesson;

class LessonController extends Controller
{
    public function toggleComplete(Lesson $lesson)
    {
        $user = auth()->user();
        
        $pivot = $user->completedLessons()->where('lesson_id', $lesson->id)->first();

        if ($pivot) {
             $user->completedLessons()->detach($lesson->id);
        } else {
             $user->completedLessons()->attach($lesson->id, ['completed_at' => now()]);
        }

        return back();
    }
}
