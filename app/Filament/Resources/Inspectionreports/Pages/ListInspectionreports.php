<?php

namespace App\Filament\Resources\Inspectionreports\Pages;

use App\Filament\Resources\Inspectionreports\InspectionreportResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInspectionreports extends ListRecords
{
    protected static string $resource = InspectionreportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
