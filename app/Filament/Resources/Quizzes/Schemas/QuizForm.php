<?php

namespace App\Filament\Resources\Quizzes\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class QuizForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Quiz Details')
                    ->schema([
                        Select::make('course_id')
                            ->relationship('course', 'title')
                            ->required()
                            ->searchable(),
                        TextInput::make('title')
                            ->required(),
                        RichEditor::make('description')
                            ->columnSpanFull(),
                        TextInput::make('passing_percentage')
                            ->required()
                            ->numeric()
                            ->default(80)
                            ->suffix('%'),
                    ]),

                Section::make('Questions')
                    ->schema([
                        Repeater::make('questions')
                            ->relationship()
                            ->schema([
                                RichEditor::make('question_text')
                                    ->required()
                                    ->columnSpanFull(),
                                Select::make('question_type')
                                    ->options([
                                        'multiple_choice' => 'Multiple Choice',
                                    ])
                                    ->default('multiple_choice')
                                    ->required(),
                                Repeater::make('options')
                                    ->schema([
                                        TextInput::make('text')->required(),
                                    ])
                                    ->itemLabel(fn (array $state): ?string => $state['text'] ?? null)
                                    ->grid(2)
                                    ->required(),
                                TextInput::make('correct_answer')
                                    ->helperText('Masukan teks jawaban yang benar persis seperti di pilihan')
                                    ->required(),
                            ])
                            ->orderColumn('sort_order')
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => strip_tags($state['question_text'] ?? 'New Question')),
                    ]),
            ]);
    }
}
