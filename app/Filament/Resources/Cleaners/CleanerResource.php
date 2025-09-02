<?php

namespace App\Filament\Resources\Cleaners;

use App\Filament\Resources\Cleaners\Pages\CreateCleaner;
use App\Filament\Resources\Cleaners\Pages\EditCleaner;
use App\Filament\Resources\Cleaners\Pages\ListCleaners;
use App\Filament\Resources\Cleaners\Pages\ViewCleaner;
use App\Filament\Resources\Cleaners\Schemas\CleanerForm;
use App\Filament\Resources\Cleaners\Schemas\CleanerInfolist;
use App\Filament\Resources\Cleaners\Tables\CleanersTable;
use App\Models\Cleaner;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CleanerResource extends Resource
{
    protected static ?string $model = Cleaner::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;

    protected static ?string $recordTitleAttribute = 'full_name';

    protected static string|UnitEnum|null $navigationGroup = 'User Management';

    public static function form(Schema $schema): Schema
    {
        return CleanerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CleanerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CleanersTable::configure($table);
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
            'index' => ListCleaners::route('/'),
            'create' => CreateCleaner::route('/create'),
            'view' => ViewCleaner::route('/{record}'),
            'edit' => EditCleaner::route('/{record}/edit'),
        ];
    }
}
