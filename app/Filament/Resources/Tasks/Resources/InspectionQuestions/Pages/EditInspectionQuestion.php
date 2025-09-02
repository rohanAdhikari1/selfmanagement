<?php

namespace App\Filament\Resources\Tasks\Resources\InspectionQuestions\Pages;

use App\Filament\Resources\Tasks\Resources\InspectionQuestions\InspectionQuestionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditInspectionQuestion extends EditRecord
{
    protected static string $resource = InspectionQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
