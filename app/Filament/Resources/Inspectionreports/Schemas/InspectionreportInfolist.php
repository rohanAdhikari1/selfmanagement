<?php

namespace App\Filament\Resources\Inspectionreports\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InspectionreportInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Report Details')
                    ->icon('heroicon-o-document-text')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextEntry::make('report_number')
                            ->label('Report No.'),
                        TextEntry::make('title')
                            ->label('Title')
                            ->placeholder('-'),
                        TextEntry::make('site.name')
                            ->label('Site'),
                        TextEntry::make('inspection_type')
                            ->label('Inspection Type')
                            ->placeholder('-'),
                        TextEntry::make('frequency')
                            ->label('Frequency')
                            ->placeholder('-'),
                        IconEntry::make('is_active')
                            ->boolean()
                            ->label('Active'),
                    ]),

                Section::make('Modifier Info')
                    ->icon('heroicon-o-user')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('creator_name')
                            ->label('Created By')
                            ->numeric()
                            ->placeholder('-'),
                        TextEntry::make('updator_name')
                            ->label('Updated By')
                            ->numeric()
                            ->placeholder('-'),
                    ]),

                Section::make('Timestamps')
                    ->icon('heroicon-o-clock')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Created At')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->label('Updated At')
                            ->dateTime()
                            ->placeholder('-'),
                    ]),


                RepeatableEntry::make('items')
                    ->schema([
                        TextEntry::make('question.name')
                            ->label('Question')
                            ->placeholder('-'),
                        TextEntry::make('answer.name')
                            ->badge()
                            ->label('Answer')
                            ->placeholder('-'),
                        TextEntry::make('obtained_point')
                            ->label('Obtained Point')
                            ->badge()
                            ->placeholder('-'),
                        TextEntry::make('remarks')
                            ->label('Remarks')
                            ->placeholder('-'),
                    ])
                    ->columns(4)
                    ->columnSpanFull()

            ]);
    }
}
