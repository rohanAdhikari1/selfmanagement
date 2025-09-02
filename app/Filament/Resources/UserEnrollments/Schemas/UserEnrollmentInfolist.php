<?php

namespace App\Filament\Resources\UserEnrollments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserEnrollmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('cleaner.full_name'),
                TextEntry::make('site.name'),
                TextEntry::make('from_time')
                    ->label('Expected From Time')
                    ->time(),
                TextEntry::make('to_time')
                    ->label('Expected To Time')
                    ->time(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
