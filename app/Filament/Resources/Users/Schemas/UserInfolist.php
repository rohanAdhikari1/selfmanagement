<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('full_name'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('username'),
                TextEntry::make('phone'),
                TextEntry::make('is_active'),
                TextEntry::make('address1'),
                TextEntry::make('address2'),
                TextEntry::make('avatar'),
                TextEntry::make('email_verified_at')
                    ->dateTime(),
                TextEntry::make('police_report'),
                TextEntry::make('official_document'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('company_id')
                    ->numeric(),
                TextEntry::make('site_id')
                    ->numeric(),
            ]);
    }
}
