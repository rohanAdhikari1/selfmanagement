<?php

namespace App\Filament\Resources\Inspectionreports;

use App\Filament\Resources\Inspectionreports\Pages\CreateInspectionreport;
use App\Filament\Resources\Inspectionreports\Pages\EditInspectionreport;
use App\Filament\Resources\Inspectionreports\Pages\ListInspectionreports;
use App\Filament\Resources\Inspectionreports\Pages\ViewInspectionreport;
use App\Filament\Resources\Inspectionreports\Schemas\InspectionreportForm;
use App\Filament\Resources\Inspectionreports\Schemas\InspectionreportInfolist;
use App\Filament\Resources\Inspectionreports\Tables\InspectionreportsTable;
use App\Models\Inspectionreport;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class InspectionreportResource extends Resource
{
    protected static ?string $model = Inspectionreport::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentCheck;

    protected static ?string $modelLabel = 'Inspection Report';

    protected static string|UnitEnum|null $navigationGroup = 'Report Management';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return InspectionreportForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return InspectionreportInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InspectionreportsTable::configure($table);
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
            'index' => ListInspectionreports::route('/'),
            'create' => CreateInspectionreport::route('/create'),
            'view' => ViewInspectionreport::route('/{record}'),
            'edit' => EditInspectionreport::route('/{record}/edit'),
        ];
    }
}
