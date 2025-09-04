<?php

namespace App\Filament\Resources\Companies\Resources\CompanyUsers\Pages;

use App\Filament\Resources\Companies\Resources\CompanyUsers\CompanyUserResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCompanyUser extends EditRecord
{
    protected static string $resource = CompanyUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
