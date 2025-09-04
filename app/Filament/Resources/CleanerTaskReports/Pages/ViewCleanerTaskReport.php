<?php

namespace App\Filament\Resources\CleanerTaskReports\Pages;

use App\Filament\Resources\CleanerTaskReports\CleanerTaskReportResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCleanerTaskReport extends ViewRecord
{
    protected static string $resource = CleanerTaskReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
