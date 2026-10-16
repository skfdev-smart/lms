<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizAttemptResource\Pages;
use App\Models\QuizAttempt;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class QuizAttemptResource extends Resource
{
    protected static ?string $model = QuizAttempt::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-chart-bar';
    
    protected static \UnitEnum|string|null $navigationGroup = 'Reports';

    protected static ?string $navigationLabel = 'Quiz Results';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('quiz_id')
                    ->relationship('quiz', 'title')
                    ->required(),
                Forms\Components\TextInput::make('score')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('is_passed')
                    ->required(),
                Forms\Components\DateTimePicker::make('completed_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Learner')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quiz.title')
                    ->label('Quiz')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quiz.course.title')
                    ->label('Course')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('score')
                    ->numeric()
                    ->sortable()
                    ->suffix('%')
                    ->color(fn (string $state): string => $state >= 70 ? 'success' : 'danger'),
                Tables\Columns\IconColumn::make('is_passed')
                    ->boolean()
                    ->label('Status'),
                Tables\Columns\TextColumn::make('completed_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user')
                    ->relationship('user', 'name')
                    ->label('Learner')
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('course')
                    ->relationship('quiz.course', 'title')
                    ->label('Course')
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('quiz')
                    ->relationship('quiz', 'title')
                    ->searchable()
                    ->preload(),
                Tables\Filters\Filter::make('completed_at')
                    ->form([
                        Forms\Components\DatePicker::make('completed_from'),
                        Forms\Components\DatePicker::make('completed_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['completed_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('completed_at', '>=', $date),
                            )
                            ->when(
                                $data['completed_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('completed_at', '<=', $date),
                            );
                    }),
                Tables\Filters\TernaryFilter::make('is_passed')
                    ->label('Pass Status'),
            ])
            ->recordActions([])
            ->toolbarActions([])
            ->defaultSort('completed_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageQuizAttempts::route('/'),
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
