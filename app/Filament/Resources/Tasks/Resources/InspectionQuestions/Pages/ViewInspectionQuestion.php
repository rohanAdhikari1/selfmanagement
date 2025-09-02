<?php

namespace App\Filament\Resources\Tasks\Resources\InspectionQuestions\Pages;

use App\Filament\Resources\Tasks\Resources\InspectionQuestions\InspectionQuestionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewInspectionQuestion extends ViewRecord
{
    protected static string $resource = InspectionQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
