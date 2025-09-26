<?php

namespace App\Filament\Resources\SiteInspectionQuestionExceptions\Pages;

use App\Filament\Resources\SiteInspectionQuestionExceptions\SiteInspectionQuestionExceptionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageSiteInspectionQuestionExceptions extends ManageRecords
{
    protected static string $resource = SiteInspectionQuestionExceptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
