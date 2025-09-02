<?php

namespace App\Filament\Resources\Tasks\Pages;

use App\Filament\Resources\Tasks\Resources\InspectionQuestions\InspectionQuestionResource;
use App\Filament\Resources\Tasks\TaskResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables\Table;

class ManageTaskInspectionQuestions extends ManageRelatedRecords
{
    protected static string $resource = TaskResource::class;

    protected static string $relationship = 'inspectionQuestions';

    protected static ?string $relatedResource = InspectionQuestionResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
