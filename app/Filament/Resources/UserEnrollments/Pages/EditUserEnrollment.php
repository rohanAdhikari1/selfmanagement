<?php

namespace App\Filament\Resources\UserEnrollments\Pages;

use App\Filament\Resources\UserEnrollments\UserEnrollmentResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditUserEnrollment extends EditRecord
{
    protected static string $resource = UserEnrollmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
