<?php

namespace App\Filament\Resources\Companies\Pages;

use App\Filament\Resources\Companies\CompanyResource;
use App\Filament\Resources\Companies\Resources\CompanyUsers\CompanyUserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables\Table;

class ManageClientUser extends ManageRelatedRecords
{
    protected static string $resource = CompanyResource::class;

    protected static string $relationship = 'users';

    protected static ?string $relatedResource = CompanyUserResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
