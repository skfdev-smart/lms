<?php

namespace App\Filament\Resources\CertificateSettings;

use App\Filament\Resources\CertificateSettings\Pages\CreateCertificateSetting;
use App\Filament\Resources\CertificateSettings\Pages\EditCertificateSetting;
use App\Filament\Resources\CertificateSettings\Pages\ListCertificateSettings;
use App\Filament\Resources\CertificateSettings\Schemas\CertificateSettingForm;
use App\Filament\Resources\CertificateSettings\Tables\CertificateSettingsTable;
use App\Models\CertificateSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class CertificateSettingResource extends Resource
{
    protected static ?string $model = CertificateSetting::class;

    protected static string|\UnitEnum|null $navigationGroup = 'Settings';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $navigationLabel = 'Certificate Signers';

    protected static ?string $slug = 'certificate-signers';

    protected static ?string $recordTitleAttribute = 'signer_name';

    public static function form(Schema $schema): Schema
    {
        return CertificateSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CertificateSettingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCertificateSettings::route('/'),
            'create' => CreateCertificateSetting::route('/create'),
            'edit' => EditCertificateSetting::route('/{record}/edit'),
        ];
    }
}
