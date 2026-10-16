<?php

namespace App\Filament\Resources\LearnerProgressResource\Pages;

use App\Filament\Resources\LearnerProgressResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLearnerProgress extends ManageRecords
{
    protected static string $resource = LearnerProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
