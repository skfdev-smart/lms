<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'user_id', 
        'course_id', 
        'quiz_attempt_id', 
        'certificate_number', 
        'issued_at',
        'signer_name',
        'signer_position',
        'signature_path'
    ];

    protected $casts = [
        'issued_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function quizAttempt()
    {
        return $this->belongsTo(QuizAttempt::class);
    }

    public static function generateCertificateNumber(): string
    {
        $prefix = 'SPINDO-LMS';
        $date = now()->format('Ymd');
        $random = strtoupper(substr(md5(uniqid()), 0, 6));
        return "{$prefix}-{$date}-{$random}";
    }
}
