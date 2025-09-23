<?php

namespace App\Filament\Resources\UserEnrollments\Pages;

use App\Filament\Resources\UserEnrollments\UserEnrollmentResource;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateUserEnrollment extends CreateRecord
{
    protected static string $resource = UserEnrollmentResource::class;

    protected function afterCreate(): void
    {
        $cleaner = User::find($this->record->user_id);
        if ($cleaner) {
            $cleaner->notifyNow(
                Notification::make()
                    ->title('New Site Available.')
                    ->body('You are enrolled to the new site ' . $this->record->name)
                    ->toDatabase(),
            );
        }
    }
}
