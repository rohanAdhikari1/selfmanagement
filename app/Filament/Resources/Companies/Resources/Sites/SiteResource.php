<?php

namespace App\Filament\Resources\Companies\Resources\Sites;

use App\Filament\Resources\Companies\CompanyResource;
use App\Filament\Resources\Companies\Resources\Sites\Pages\CreateSite;
use App\Filament\Resources\Companies\Resources\Sites\Pages\EditSite;
use App\Filament\Resources\Companies\Resources\Sites\Pages\ViewSite;
use App\Filament\Resources\Companies\Resources\Sites\Tables\SitesTable;
use App\Filament\Resources\Companies\Schemas\CompanyForm;
use App\Filament\Resources\Companies\Schemas\CompanyInfolist;
use App\Models\Site;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SiteResource extends Resource
{
    protected static ?string $model = Site::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $parentResource = CompanyResource::class;

    protected static ?string $recordTitleAttribute = 'name';


    public static function form(Schema $schema): Schema
    {
        return CompanyForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CompanyInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SitesTable::configure($table);
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
            'create' => CreateSite::route('/create'),
            'view' => ViewSite::route('/{record}'),
            'edit' => EditSite::route('/{record}/edit'),
        ];
    }
}
