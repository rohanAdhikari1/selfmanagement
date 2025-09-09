<?php

namespace App\Filament\Resources\Cleaners\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CleanerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('👤 Cleaner Information')
                    ->description('Personal details of the cleaner.')
                    ->collapsible()
                    ->schema([
                        Grid::make(['default' => 1, 'md' => 2])
                            ->schema([
                                TextEntry::make('full_name')
                                    ->label('Full Name')
                                    ->icon('heroicon-o-user'),

                                TextEntry::make('username')
                                    ->icon('heroicon-o-identification'),

                                TextEntry::make('email')
                                    ->icon('heroicon-o-envelope'),

                                TextEntry::make('phone')
                                    ->label('Phone Number')
                                    ->icon('heroicon-o-phone'),
                            ]),
                    ]),

                Section::make('📄 Documents & Status')
                    ->description('Verification and records.')
                    ->collapsible()
                    ->schema([
                        IconEntry::make('is_active')
                            ->label('Active Status')
                            ->boolean(),

                        ImageEntry::make('avatar')
                            ->label('Profile Photo')
                            ->hidden(fn($record) => blank($record->avatar)),

                        TextEntry::make('email_verified_at')
                            ->dateTime()
                            ->label('Email Verified At')
                            ->icon('heroicon-o-check-circle'),

                        TextEntry::make('police_report')
                            ->label('Police Report')
                            ->hint('Available Soon')
                            ->icon('heroicon-o-document-text'),

                        TextEntry::make('official_document')
                            ->label('Official Document')
                            ->hint('Available Soon')
                            ->icon('heroicon-o-document'),
                    ])->columns(2),

                Section::make('🏠 Address Information')
                    ->description('Cleaner\'s address details.')
                    ->collapsible()
                    ->schema([
                        Grid::make(['default' => 1, 'md' => 2])
                            ->schema([
                                TextEntry::make('address1')
                                    ->label('Address Line 1')
                                    ->icon('heroicon-o-map-pin'),

                                TextEntry::make('address2')
                                    ->label('Address Line 2')
                                    ->icon('heroicon-o-map'),
                            ]),
                    ]),

                Section::make('📊 System Metadata')
                    ->description('Internal system tracking fields.')
                    ->collapsed()
                    ->schema([
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->label('Created At')
                            ->icon('heroicon-o-calendar'),

                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->label('Last Updated')
                            ->icon('heroicon-o-arrow-path'),

                        TextEntry::make('company.name')
                            ->label('Company')
                            ->hidden(fn($record) => blank($record->company_id)),
                    ])
                    ->columns(2),
            ]);
    }
}
