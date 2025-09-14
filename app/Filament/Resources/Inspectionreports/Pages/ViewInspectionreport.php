<?php

namespace App\Filament\Resources\Inspectionreports\Pages;

use App\Filament\Resources\Inspectionreports\InspectionreportResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewInspectionreport extends ViewRecord
{
    protected static string $resource = InspectionreportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
