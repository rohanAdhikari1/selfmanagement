<?php

namespace App\Filament\Resources\Sites\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SiteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('company_id')
                    ->label('Company')
                    ->relationship('company', 'name')
                    ->searchable()
                    ->required()
                    ->preload()
                    ->visible(fn($livewire) => $livewire instanceof \App\Filament\Resources\Sites\Pages\EditSite || $livewire instanceof \App\Filament\Resources\Sites\Pages\CreateSite)
                    ->columnSpan(2),
                TextInput::make('name')
                    ->label('Full Name')
                    ->placeholder('Enter full legal name')
                    ->required()
                    ->autofocus()
                    ->columnSpan(2),
                TextInput::make('tax_id')
                    ->label('Tax ID')
                    ->placeholder('Enter tax identification number')
                    ->default(null)
                    ->helperText('Optional')
                    ->columnSpan(1),

                TextInput::make('phone')
                    ->label('Phone Number')
                    ->placeholder('+1 (555) 123-4567')
                    ->tel(),
                TextInput::make('email')
                    ->label('Email Address')
                    ->placeholder('name@example.com')
                    ->email()
                    ->default(null)
                    ->columnSpan(2),
                TextInput::make('address1')
                    ->label('Street Address')
                    ->placeholder('123 Main St')
                    ->default(null)
                    ->columnSpan(2),
                TextInput::make('address2')
                    ->label('Apartment / Suite')
                    ->placeholder('Apt 4B')
                    ->default(null)
                    ->columnSpan(2),
            ]);
    }
}
