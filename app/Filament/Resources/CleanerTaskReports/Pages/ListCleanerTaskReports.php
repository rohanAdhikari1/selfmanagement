<?php

namespace App\Filament\Resources\CleanerTaskReports\Pages;

use App\Filament\Resources\CleanerTaskReports\CleanerTaskReportResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Model;

class ListCleanerTaskReports extends ListRecords
{
    protected static string $resource = CleanerTaskReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }

    public function getTableRecordKey(Model | array $record): string
    {
        return $record->site_id;
    }
}
