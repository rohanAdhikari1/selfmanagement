<?php

namespace App\Filament\Resources\UserEnrollments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class UserEnrollmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Cleaner Details')
                    ->icon(Heroicon::User)
                    ->schema([
                        TextEntry::make('cleaner.full_name')
                            ->label('Full Name')
                            ->placeholder('N/A'),
                    ]),

                Section::make('Site Information')
                    ->icon(Heroicon::BuildingOffice)
                    ->schema([
                        TextEntry::make('site.name')
                            ->label('Name')
                            ->placeholder('Not Assigned'),
                    ]),
                Section::make('Schedule')
                    ->icon(Heroicon::Clock)
                    ->columns(2)
                    ->schema([
                        TextEntry::make('from_time')
                            ->label('From')
                            ->time()
                            ->badge()
                            ->color('success'),
                        TextEntry::make('to_time')
                            ->label('To')
                            ->time()
                            ->badge()
                            ->color('danger'),
                    ]),

                Section::make('System Info')
                    ->icon(Heroicon::CalendarDays)
                    ->columns(2)
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Created')
                            ->dateTime('M d, Y H:i'),
                        TextEntry::make('updated_at')
                            ->label('Last Updated')
                            ->dateTime('M d, Y H:i'),
                    ]),
            ]);
    }
}
