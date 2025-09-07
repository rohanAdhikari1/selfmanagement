<?php

namespace App\Filament\Resources\CleanerAttendances\Pages;

use App\Filament\Resources\CleanerAttendances\CleanerAttendanceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageCleanerAttendances extends ManageRecords
{
    protected static string $resource = CleanerAttendanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->hidden(fn() => auth()->user()->hasAnyRole(['cleaner', 'company_user', 'site_user'])),
        ];
    }
}
