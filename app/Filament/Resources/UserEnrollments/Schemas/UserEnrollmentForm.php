<?php

namespace App\Filament\Resources\UserEnrollments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UserEnrollmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->required()
                    ->label('Cleaner')
                    ->relationship('cleaner', 'full_name')
                    ->searchable()
                    ->preload(),
                Select::make('site_id')
                    ->required()
                    ->relationship('site', 'name')
                    ->searchable()
                    ->preload()
                    ->getOptionLabelFromRecordUsing(fn($record) => "{$record->name} - {$record->company->name}"),
                Textarea::make('remarks')
                    ->default(null)
                    ->columnSpanFull(),
                TimePicker::make('from_time')
                    ->label('Expected From Time'),
                TimePicker::make('to_time')
                    ->label('Expected To Time'),
                Toggle::make('status')
                    ->default(true)
                    ->required()
            ]);
    }
}
