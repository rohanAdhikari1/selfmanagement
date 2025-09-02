<?php

namespace App\Filament\Resources\UserEnrollments\Pages;

use App\Filament\Resources\UserEnrollments\UserEnrollmentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUserEnrollment extends CreateRecord
{
    protected static string $resource = UserEnrollmentResource::class;
}
