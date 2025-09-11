<?php

namespace App\Filament\Resources\CleanerTaskReports\Pages;

use App\Filament\Resources\CleanerTaskReports\CleanerTaskReportResource;
use Filament\Resources\Pages\ListRecords;

class ListCleanerTaskReports extends ListRecords
{
    protected static string $resource = CleanerTaskReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
