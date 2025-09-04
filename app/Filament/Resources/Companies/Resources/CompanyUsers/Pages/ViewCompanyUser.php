<?php

namespace App\Filament\Resources\Companies\Resources\CompanyUsers\Pages;

use App\Filament\Resources\Companies\Resources\CompanyUsers\CompanyUserResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCompanyUser extends ViewRecord
{
    protected static string $resource = CompanyUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
