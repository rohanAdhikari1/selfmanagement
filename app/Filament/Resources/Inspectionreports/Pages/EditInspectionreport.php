<?php

namespace App\Filament\Resources\Inspectionreports\Pages;

use App\Filament\Resources\Inspectionreports\InspectionreportResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditInspectionreport extends EditRecord
{
    protected static string $resource = InspectionreportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
