<?php

namespace App\Filament\Resources\QuizAttemptResource\Pages;

use App\Filament\Resources\QuizAttemptResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageQuizAttempts extends ManageRecords
{
    protected static string $resource = QuizAttemptResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
