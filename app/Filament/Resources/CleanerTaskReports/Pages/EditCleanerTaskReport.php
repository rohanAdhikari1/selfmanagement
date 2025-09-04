<?php

namespace App\Filament\Resources\CleanerTaskReports\Pages;

use App\Filament\Resources\CleanerTaskReports\CleanerTaskReportResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCleanerTaskReport extends EditRecord
{
    protected static string $resource = CleanerTaskReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
