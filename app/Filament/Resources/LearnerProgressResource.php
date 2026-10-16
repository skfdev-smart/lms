<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LearnerProgressResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class LearnerProgressResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $slug = 'learner-progress';
    
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-academic-cap';

    protected static \UnitEnum|string|null $navigationGroup = 'Reports';
    
    protected static ?string $navigationLabel = 'Learner Progress';

    protected static ?int $navigationSort = 2;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('department.name')
                    ->label('Department')
                    ->sortable(),
                Tables\Columns\TextColumn::make('courses_count')
                    ->counts('courses')
                    ->label('Enrolled Courses')
                    ->sortable(),
                Tables\Columns\TextColumn::make('completed_courses_count')
                    ->label('Completed Courses')
                    ->counts('courses', fn (Builder $query) => $query->whereHas('lessons', function ($q) {
                        // Complex query logic simplified: just count courses where exists all lessons completed?
                        // Actually Eloquent counts with callback are tricky for "all relation children".
                        // Simplification: We will just count 'certificates' as proxy for completed courses (since we implemented certificates)
                        // This is MUCH closer to truth since certificate = completion.
                    }))
                    ->state(function (User $record) {
                        // Alternative: use Certificates count
                        return $record->certificates()->count();
                    })
                    ->badge()
                    ->color('success')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('department')
                    ->relationship('department', 'name'),
            ])
            ->actions([])
            ->bulkActions([])
            ->defaultSort('name');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageLearnerProgress::route('/'),
        ];
    }
    
    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }
    
    public static function canDelete($record): bool
    {
        return false;
    }
}
