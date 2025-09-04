<?php

namespace App\Filament\Resources\Companies\Resources\Sites\Pages;

use App\Filament\Resources\Companies\Resources\Sites\SitesResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSites extends ViewRecord
{
    protected static string $resource = SitesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
