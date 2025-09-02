<?php

namespace App\Filament\Resources\Companies\Pages;

use App\Filament\Resources\Companies\CompanyResource;
use App\Filament\Resources\Companies\Resources\Sites\SiteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables\Table;

class ManageCompanySites extends ManageRelatedRecords
{
    protected static string $resource = CompanyResource::class;

    protected static string $relationship = 'Sites';

    protected static ?string $relatedResource = SiteResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
