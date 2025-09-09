<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('👤 Cleaner Information')
                    ->description('Personal details of the cleaner.')
                    ->collapsible()
                    ->schema([
                        Grid::make(['default' => 1, 'md' => 5])
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
                                    ])->columnSpan(4),
                                ImageEntry::make('avatar')
                                    ->label('Avatar')
                                    ->imageHeight(50)
                            ]),
                    ])
                    ->columnSpanFull(),

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
                    ->collapsible()
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

                        TextEntry::make('site.name')
                            ->label('Site')
                            ->hidden(fn($record) => blank($record->site_id)),
                    ])
                    ->columns(2),
            ]);
    }
}
