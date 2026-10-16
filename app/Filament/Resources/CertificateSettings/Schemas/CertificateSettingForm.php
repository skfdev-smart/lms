<?php

namespace App\Filament\Resources\CertificateSettings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CertificateSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('signer_name')
                    ->required()
                    ->placeholder('e.g. Nala Surya Permana'),
                TextInput::make('signer_position')
                    ->required()
                    ->placeholder('e.g. Director of Training'),
                \Filament\Forms\Components\FileUpload::make('signature_path')
                    ->label('Digital Signature')
                    ->image()
                    ->directory('signatures')
                    ->visibility('public')
                    ->required(),
            ]);
    }
}
