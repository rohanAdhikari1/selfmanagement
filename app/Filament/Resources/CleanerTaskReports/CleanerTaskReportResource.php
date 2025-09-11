<?php

namespace App\Filament\Resources\CleanerTaskReports;

use App\Filament\Resources\CleanerTaskReports\Pages\CreateCleanerTaskReport;
use App\Filament\Resources\CleanerTaskReports\Pages\EditCleanerTaskReport;
use App\Filament\Resources\CleanerTaskReports\Pages\ListCleanerTaskReports;
use App\Filament\Resources\CleanerTaskReports\Pages\ViewCleanerTaskReport;
use App\Filament\Resources\CleanerTaskReports\Schemas\CleanerTaskReportForm;
use App\Filament\Resources\CleanerTaskReports\Schemas\CleanerTaskReportInfolist;
use App\Filament\Resources\CleanerTaskReports\Tables\CleanerTaskReportsTable;
use App\Models\CleanerTaskReport;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CleanerTaskReportResource extends Resource
{
    protected static ?string $model = CleanerTaskReport::class;

    // protected static ?int $navigationSort = 6;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ReceiptPercent;

    protected static string|UnitEnum|null $navigationGroup = 'Report Management';

    public static function form(Schema $schema): Schema
    {
        return CleanerTaskReportForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CleanerTaskReportInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CleanerTaskReportsTable::configure($table);
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
            'index' => ListCleanerTaskReports::route('/'),
            'create' => CreateCleanerTaskReport::route('/create'),
            'view' => ViewCleanerTaskReport::route('/{record}'),
            'edit' => EditCleanerTaskReport::route('/{record}/edit'),
        ];
    }
}
