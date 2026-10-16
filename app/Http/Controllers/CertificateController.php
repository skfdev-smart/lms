<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = auth()->user()->certificates()
            ->with(['course', 'quizAttempt'])
            ->orderBy('issued_at', 'desc')
            ->get();

        return Inertia::render('Certificates/Index', [
            'certificates' => $certificates,
        ]);
    }

    public function show(Certificate $certificate)
    {
        // Ensure user owns this certificate
        if ($certificate->user_id !== auth()->id()) {
            abort(403);
        }

        $certificate->load(['course', 'user', 'quizAttempt']);

        // Use signer info from certificate if available (for persistence), 
        // otherwise fallback to course signer or system default
        $settings = (object) [
            'signer_name' => $certificate->signer_name ?? $certificate->course->certificateSigner?->signer_name,
            'signer_position' => $certificate->signer_position ?? $certificate->course->certificateSigner?->signer_position,
            'signature_path' => $certificate->signature_path ?? $certificate->course->certificateSigner?->signature_path,
        ];

        // Ensure we have a default if any info is missing (legacy certificates)
        if (!$settings->signature_path || !$settings->signer_name) {
            $defaultSetting = \App\Models\CertificateSetting::first();
            $settings->signer_name = $settings->signer_name ?? $defaultSetting?->signer_name ?? 'Director of Training';
            $settings->signer_position = $settings->signer_position ?? $defaultSetting?->signer_position ?? 'Director of Training';
            $settings->signature_path = $settings->signature_path ?? $defaultSetting?->signature_path;
        }

        return Inertia::render('Certificates/Show', [
            'certificate' => $certificate,
            'settings' => $settings,
        ]);
    }

    public function generate(Course $course)
    {
        $user = auth()->user();

        // Check if certificate already exists
        $existingCert = Certificate::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if ($existingCert) {
            return redirect()->route('certificate.show', $existingCert);
        }

        // Check if user has passed the quiz
        $quiz = $course->quiz;
        if (!$quiz) {
            return back()->with('error', 'This course does not have a quiz.');
        }

        $passedAttempt = QuizAttempt::where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->where('is_passed', true)
            ->latest()
            ->first();

        if (!$passedAttempt) {
            return back()->with('error', 'You must pass the quiz to get a certificate.');
        }

        // Capture signer info from course
        $signer = $course->certificateSigner;
        
        // Generate certificate
        $certificate = Certificate::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'quiz_attempt_id' => $passedAttempt->id,
            'certificate_number' => Certificate::generateCertificateNumber(),
            'issued_at' => now(),
            // Persist signer info
            'signer_name' => $signer?->signer_name,
            'signer_position' => $signer?->signer_position,
            'signature_path' => $signer?->signature_path,
        ]);

        return redirect()->route('certificate.show', $certificate);
    }
    public function verify($certificate_number)
    {
        \Illuminate\Support\Facades\Log::info("Verifying certificate: " . $certificate_number);

        $certificate = Certificate::where('certificate_number', $certificate_number)
            ->with(['user', 'course', 'quizAttempt'])
            ->first();

        if (!$certificate) {
            \Illuminate\Support\Facades\Log::warning("Certificate not found: " . $certificate_number);
            abort(404, 'Certificate not found in records.');
        }

        // Use signer info from certificate if available, fallback to system default
        $settings = (object) [
            'signer_name' => $certificate->signer_name ?? $certificate->course->certificateSigner?->signer_name,
            'signer_position' => $certificate->signer_position ?? $certificate->course->certificateSigner?->signer_position,
            'signature_path' => $certificate->signature_path ?? $certificate->course->certificateSigner?->signature_path,
        ];

        if (!$settings->signature_path || !$settings->signer_name) {
            $defaultSetting = \App\Models\CertificateSetting::first();
            $settings->signer_name = $settings->signer_name ?? $defaultSetting?->signer_name ?? 'Director of Training';
            $settings->signer_position = $settings->signer_position ?? $defaultSetting?->signer_position ?? 'Director of Training';
            $settings->signature_path = $settings->signature_path ?? $defaultSetting?->signature_path;
        }

        return Inertia::render('Certificates/Verify', [
            'certificate' => $certificate,
            'settings' => $settings,
        ]);
    }
}
