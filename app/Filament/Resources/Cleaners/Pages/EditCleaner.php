<?php

namespace App\Filament\Resources\Cleaners\Pages;

use App\Filament\Resources\Cleaners\CleanerResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCleaner extends EditRecord
{
    protected static string $resource = CleanerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
