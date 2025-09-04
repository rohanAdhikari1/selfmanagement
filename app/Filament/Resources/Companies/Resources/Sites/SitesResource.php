<?php

namespace App\Filament\Resources\Companies\Resources\Sites;

use App\Filament\Resources\Companies\CompanyResource;
use App\Filament\Resources\Companies\Resources\Sites\Pages\CreateSites;
use App\Filament\Resources\Companies\Resources\Sites\Pages\EditSites;
use App\Filament\Resources\Companies\Resources\Sites\Pages\ViewSites;
use App\Filament\Resources\Sites\Schemas\SiteForm;
use App\Filament\Resources\Sites\Schemas\SiteInfolist;
use App\Filament\Resources\Sites\Tables\SitesTable;
use App\Models\Site;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SitesResource extends Resource
{
    protected static ?string $model = Site::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $parentResource = CompanyResource::class;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return SiteForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SitesTable::configure($table);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SiteInfolist::configure($schema);
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
            'create' => CreateSites::route('/create'),
            'edit' => EditSites::route('/{record}/edit'),
            'view' => ViewSites::route('/{record}/view'),
        ];
    }
}
