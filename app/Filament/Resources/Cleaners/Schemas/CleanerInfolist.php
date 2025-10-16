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
                // 👤 Cleaner Profile
                Section::make('👤 Cleaner Profile')
                    ->columnSpanFull()
                    ->description('Personal and contact details of the cleaner.')
                    ->schema([
                        Grid::make(['default' => 1, 'md' => 12])
                            ->schema([
                                // 🖼️ Photo on the left
                                ImageEntry::make('avatar')
                                    ->columnSpan(2)
                                    ->label('Profile')
                                    ->hiddenLabel()
                                    ->circular()
                                    ->extraAttributes(['class' => '!text-center'])
                                    ->alignCenter()
                                    ->hidden(fn($record) => blank($record->avatar)),

                                // 📋 Details on the right
                                Grid::make(['default' => 1, 'md' => 2])
                                    ->columnSpan(fn($record) => blank($record->avatar) ? 12 : 10)
                                    ->schema([
                                        Grid::make(['default' => 1, 'md' => 2])
                                            ->schema([
                                                TextEntry::make('full_name')
                                                    ->label('Full Name')
                                                    ->icon('heroicon-o-user'),

                                                TextEntry::make('username')
                                                    ->label('Username')
                                                    ->icon('heroicon-o-identification'),
                                            ]),

                                        Grid::make(['default' => 1])
                                            ->schema([
                                                TextEntry::make('email')
                                                    ->label('Email')
                                                    ->icon('heroicon-o-envelope')
                                                    ->copyable(),
                                            ]),
                                        Grid::make(['default' => 1, 'md' => 2])
                                            ->schema([
                                                TextEntry::make('phone')
                                                    ->label('Phone Number')
                                                    ->icon('heroicon-o-phone')
                                                    ->copyable(),

                                                TextEntry::make('company.name')
                                                    ->label('Company')
                                                    ->icon('heroicon-o-building-office')
                                                    ->hidden(fn($record) => blank($record->company_id)),
                                            ]),
                                    ]),
                            ]),
                    ]),

                // 📄 Documents & Status
                Section::make('📄 Verification & Documents')
                    ->description('Status, verification, and documentation records.')
                    ->columnSpanFull()
                    ->columns(5)
                    ->schema([
                        Grid::make(['default' => 1, 'md' => 1])
                            ->schema([
                                IconEntry::make('is_active')
                                    ->label('Active')
                                    ->boolean()
                                    ->trueIcon('heroicon-o-check-circle')
                                    ->falseIcon('heroicon-o-x-circle'),

                                TextEntry::make('abn_number')
                                    ->label('ABN Number')
                                    ->icon('heroicon-o-hashtag')
                                    ->placeholder('Not provided'),
                            ]),

                        Grid::make(['default' => 1, 'md' => 2])
                            ->columnSpan(4)
                            ->schema([
                                ImageEntry::make('police_report')
                                    ->label('Police Report')
                                    ->hint('Available soon')
                                    ->placeholder('Not uploaded'),

                                ImageEntry::make('official_document')
                                    ->label('Official Document')
                                    ->hint('Available soon')
                                    ->placeholder('Not uploaded'),
                            ]),
                    ]),

                // 🏠 Address
                Section::make('🏠 Address Information')
                    ->description('Cleaner’s registered address details.')
                    ->schema([
                        Grid::make(['default' => 1, 'md' => 2])
                            ->schema([
                                TextEntry::make('address1')
                                    ->label('Address Line 1')
                                    ->icon('heroicon-o-map'),

                                TextEntry::make('address2')
                                    ->label('Address Line 2')
                                    ->icon('heroicon-o-map'),
                            ]),
                    ]),

                // ⚙️ Metadata
                Section::make('⚙️ System Metadata')
                    ->description('Internal system timestamps and audit details.')
                    ->schema([
                        Grid::make(['default' => 1, 'md' => 2])
                            ->schema([
                                TextEntry::make('created_at')
                                    ->dateTime()
                                    ->label('Created At')
                                    ->icon('heroicon-o-calendar'),

                                TextEntry::make('updated_at')
                                    ->dateTime()
                                    ->label('Last Updated')
                                    ->icon('heroicon-o-arrow-path'),
                            ]),
                    ]),
            ]);
    }
}
