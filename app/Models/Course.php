<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title', 
        'description', 
        'thumbnail', 
        'is_published', 
        'department_id',
        'certificate_signer_id'
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('sort_order');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('completed_at')->withTimestamps();
    }

    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function certificateSigner()
    {
        return $this->belongsTo(CertificateSetting::class, 'certificate_signer_id');
    }
}
