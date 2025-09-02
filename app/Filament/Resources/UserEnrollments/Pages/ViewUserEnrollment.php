<?php

namespace App\Filament\Resources\UserEnrollments\Pages;

use App\Filament\Resources\UserEnrollments\UserEnrollmentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUserEnrollment extends ViewRecord
{
    protected static string $resource = UserEnrollmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
