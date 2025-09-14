<?php

namespace App\Filament\Resources\Inspectionreports\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class InspectionreportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('report_number')
                    ->required(),
                TextInput::make('title')
                    ->default(null),
                TextInput::make('site_id')
                    ->required()
                    ->numeric(),
                TextInput::make('inspection_type')
                    ->default(null),
                TextInput::make('frequency')
                    ->default(null),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('created_by')
                    ->numeric()
                    ->default(null),
                TextInput::make('updated_by')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
