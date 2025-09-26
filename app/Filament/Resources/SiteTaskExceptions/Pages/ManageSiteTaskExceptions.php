<?php

namespace App\Filament\Resources\SiteTaskExceptions\Pages;

use App\Filament\Resources\SiteTaskExceptions\SiteTaskExceptionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageSiteTaskExceptions extends ManageRecords
{
    protected static string $resource = SiteTaskExceptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
