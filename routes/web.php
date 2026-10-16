<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    $qrCodeUrl = \App\Models\Setting::where('key', 'landing_qrcode_url')->value('value');
    $qrCode = $qrCodeUrl ? \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate($qrCodeUrl) : null;

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'qrCode' => $qrCode ? (string) $qrCode : null,
        'qrCodeUrl' => $qrCodeUrl,
    ]);
})->name('home');

Route::get('/catalog', function () {
    $courses = \App\Models\Course::where('is_published', true)
        ->with('department')
        ->withCount('lessons')
        ->get()
        ->map(function ($course) {
            // Append category from department name for filtering
            $course->category = $course->department?->name ?? 'General';
            return $course;
        });
    
    $enrolledCourseIds = auth()->user() ? auth()->user()->courses()->pluck('courses.id')->toArray() : [];
    $categories = \App\Models\Department::pluck('name')->toArray();
    
    return Inertia::render('Catalog', [
        'courses' => $courses,
        'enrolledCourseIds' => $enrolledCourseIds,
        'categories' => $categories,
    ]);
})->middleware(['auth', 'verified'])->name('catalog');

Route::get('/my-learning', function () {
    return Inertia::render('MyLearning', [
        'courses' => auth()->user()->courses()
            ->withCount(['lessons', 'lessons as completed_lessons_count' => function ($query) {
                $query->whereHas('users', function ($q) {
                    $q->where('user_id', auth()->id());
                });
            }])
            ->get(),
    ]);
})->middleware(['auth', 'verified'])->name('my-learning');

Route::get('/support', function () {
    return Inertia::render('Support');
})->name('support');

// Learner Dashboard
Route::get('/dashboard', function () {
    $user = auth()->user();
    
    // Get enrolled courses with completion stats
    $enrolledCourses = $user->courses()
        ->withCount(['lessons', 'lessons as completed_lessons_count' => function ($query) use ($user) {
            $query->whereHas('users', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }])
        ->get();
    
    // Calculate stats
    $totalEnrolled = $enrolledCourses->count();
    $completedCourses = $enrolledCourses->filter(function ($course) {
        return $course->lessons_count > 0 && $course->completed_lessons_count >= $course->lessons_count;
    })->count();
    $completedLessons = $user->completedLessons()->count();
    $quizzesPassed = $user->quizAttempts()->where('is_passed', true)->count();
    
    // Recent courses (limit 3)
    $recentCourses = $enrolledCourses->take(3);
    
    return Inertia::render('LearnerDashboard', [
        'user' => $user,
        'stats' => [
            'totalEnrolled' => $totalEnrolled,
            'completedCourses' => $completedCourses,
            'completedLessons' => $completedLessons,
            'quizzesPassed' => $quizzesPassed,
        ],
        'recentCourses' => $recentCourses,
        'announcements' => \App\Models\Announcement::active()->orderBy('created_at', 'desc')->take(5)->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/courses/{course}', [\App\Http\Controllers\CourseController::class, 'show'])->name('course.show');
    Route::post('/lessons/{lesson}/complete', [\App\Http\Controllers\LessonController::class, 'toggleComplete'])->name('lesson.complete');

    Route::get('/quizzes/{quiz}', [\App\Http\Controllers\QuizController::class, 'show'])->name('quiz.show');
    Route::post('/quizzes/{quiz}/submit', [\App\Http\Controllers\QuizController::class, 'submit'])->name('quiz.submit');

    // Enrollment routes
    Route::post('/courses/{course}/enroll', [\App\Http\Controllers\EnrollmentController::class, 'enroll'])->name('course.enroll');
    Route::delete('/courses/{course}/unenroll', [\App\Http\Controllers\EnrollmentController::class, 'unenroll'])->name('course.unenroll');

    // Certificate routes
    Route::get('/certificates', [\App\Http\Controllers\CertificateController::class, 'index'])->name('certificates.index');
    Route::get('/certificates/{certificate}', [\App\Http\Controllers\CertificateController::class, 'show'])->name('certificate.show');
    Route::post('/courses/{course}/certificate', [\App\Http\Controllers\CertificateController::class, 'generate'])->name('certificate.generate');
});

// Public Certificate Verification
Route::get('/verify/{certificate_number}', [\App\Http\Controllers\CertificateController::class, 'verify'])->name('certificate.verify');

require __DIR__.'/auth.php';
