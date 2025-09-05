<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('full_name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('username')
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->default(null),
                TextInput::make('is_active')
                    ->required()
                    ->default('1'),
                // TextInput::make('password')
                //     ->password()
                //     ->required(),
                TextInput::make('address1')
                    ->default(null),
                TextInput::make('address2')
                    ->default(null),
                TextInput::make('avatar')
                    ->default(null),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('police_report')
                    ->default(null),
                TextInput::make('official_document')
                    ->default(null),
                TextInput::make('company_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('site_id')
                    ->numeric()
                    ->default(null),
                Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload(),
            ]);
    }
}
