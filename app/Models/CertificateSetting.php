<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'signer_name',
        'signer_position',
        'signature_path',
    ];
}
