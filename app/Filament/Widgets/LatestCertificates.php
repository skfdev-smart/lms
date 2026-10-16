<?php

namespace App\Filament\Widgets;

use App\Models\Certificate;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestCertificates extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    
    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Certificate::query()->latest('issued_at')->limit(5)
            )
            ->columns([
                TextColumn::make('user.name')
                    ->label('Learner')
                    ->searchable(),
                TextColumn::make('course.title')
                    ->label('Course')
                    ->searchable(),
                TextColumn::make('certificate_number')
                    ->label('Certificate No.')
                    ->copyable(),
                TextColumn::make('issued_at')
                    ->label('Issued Date')
                    ->date()
                    ->sortable(),
            ])
            ->actions([
                \Filament\Actions\Action::make('verify')
                    ->url(fn (Certificate $record): string => route('certificate.verify', $record->certificate_number))
                    ->icon('heroicon-m-check-badge')
                    ->openUrlInNewTab(),
            ]);
    }
}
