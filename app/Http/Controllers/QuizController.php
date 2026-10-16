<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use Inertia\Inertia;

class QuizController extends Controller
{
    public function show(Quiz $quiz)
    {
        $quiz->load('questions');
        
        return Inertia::render('Quiz/Show', [
            'quiz' => $quiz,
        ]);
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $userAnswers = $request->input('answers'); // [question_id => selected_text]
        $quiz->load('questions');
        
        $correctCount = 0;
        $totalQuestions = $quiz->questions->count();

        foreach ($quiz->questions as $question) {
            if (isset($userAnswers[$question->id]) && $userAnswers[$question->id] === $question->correct_answer) {
                $correctCount++;
            }
        }

        $score = ($totalQuestions > 0) ? round(($correctCount / $totalQuestions) * 100) : 0;
        $isPassed = $score >= $quiz->passing_percentage;

        QuizAttempt::create([
            'user_id' => auth()->id(),
            'quiz_id' => $quiz->id,
            'score' => $score,
            'is_passed' => $isPassed,
            'completed_at' => now(),
        ]);

        return redirect()->route('course.show', $quiz->course_id);
    }
}
