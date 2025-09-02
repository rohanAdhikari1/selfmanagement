<?php

namespace App\Filament\Resources\UserEnrollments\Pages;

use App\Filament\Resources\UserEnrollments\UserEnrollmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUserEnrollments extends ListRecords
{
    protected static string $resource = UserEnrollmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
