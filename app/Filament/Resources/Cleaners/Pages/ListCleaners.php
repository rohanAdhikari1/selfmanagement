<?php

namespace App\Filament\Resources\Cleaners\Pages;

use App\Filament\Resources\Cleaners\CleanerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCleaners extends ListRecords
{
    protected static string $resource = CleanerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
