<?php

namespace App\Filament\Resources\Cleaners\Pages;

use App\Filament\Resources\Cleaners\CleanerResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCleaner extends ViewRecord
{
    protected static string $resource = CleanerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
