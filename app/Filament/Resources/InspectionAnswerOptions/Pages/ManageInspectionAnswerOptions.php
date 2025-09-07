<?php

namespace App\Filament\Resources\InspectionAnswerOptions\Pages;

use App\Filament\Resources\InspectionAnswerOptions\InspectionAnswerOptionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageInspectionAnswerOptions extends ManageRecords
{
    protected static string $resource = InspectionAnswerOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
