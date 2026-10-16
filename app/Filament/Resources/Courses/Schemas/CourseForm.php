<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->columnSpanFull(),
                Select::make('department_id')
                    ->relationship('department', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('certificate_signer_id')
                    ->label('Certificate Signer (Trainer)')
                    ->relationship('certificateSigner', 'signer_name')
                    ->searchable()
                    ->preload()
                    ->placeholder('Select a trainer for this course'),
                Textarea::make('description')
                    ->columnSpanFull(),
                FileUpload::make('thumbnail')
                    ->image()
                    ->directory('course-thumbnails'),
                Toggle::make('is_published'),

                Section::make('Curriculum')
                    ->description('Manage lessons for this course')
                    ->schema([
                        Repeater::make('lessons')
                            ->relationship()
                            ->schema([
                                TextInput::make('title')->required(),
                                Select::make('content_type')
                                    ->options([
                                        'video' => 'Video (URL)',
                                        'pdf' => 'PDF Document',
                                        'text' => 'Rich Text / Article',
                                    ])
                                    ->default('video')
                                    ->reactive(),
                                TextInput::make('content_url')
                                    ->label('Video/PDF URL')
                                    ->visible(fn ($get) => in_array($get('content_type'), ['video', 'pdf'])),
                                RichEditor::make('content_body')
                                    ->visible(fn ($get) => $get('content_type') === 'text')
                                    ->columnSpanFull(),
                            ])
                            ->orderColumn('sort_order')
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),
                    ]),
            ]);
    }
}
