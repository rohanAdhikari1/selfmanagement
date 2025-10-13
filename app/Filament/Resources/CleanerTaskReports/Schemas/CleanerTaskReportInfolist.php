<?php

namespace App\Filament\Resources\CleanerTaskReports\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class CleanerTaskReportInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Cleaner & Site')
                    ->description('Details of the assigned cleaner and site')
                    ->icon(Heroicon::ClipboardDocumentList)
                    ->schema([
                        TextEntry::make('cleaner.full_name')
                            ->label('Cleaner')
                            ->icon(Heroicon::User),
                        TextEntry::make('site.name')
                            ->label('Site')
                            ->icon(Heroicon::MapPin),
                    ])->columns(3)
                    ->columnSpanFull(),

                Section::make('Schedule')
                    ->icon(Heroicon::Clock)
                    ->schema([
                        TextEntry::make('start_time')
                            ->label('Start Time')
                            ->icon(Heroicon::Calendar),
                        TextEntry::make('finish_time')
                            ->label('Finish Time')
                            ->icon(Heroicon::Calendar),
                    ])->columns(2),
                Section::make('Metadata')
                    ->icon(Heroicon::InformationCircle)
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Created At')
                            ->icon(Heroicon::Clock),
                        TextEntry::make('updated_at')
                            ->label('Updated At')
                            ->icon(Heroicon::ArrowPath),
                    ])->columns(2),
                RepeatableEntry::make('items')
                    ->columnSpanFull()
                    ->label('Tasks')
                    ->schema([
                        TextEntry::make('task.name')
                            ->label('Task')
                            ->icon(Heroicon::CheckCircle),
                        Section::make('Images')
                            ->icon(Heroicon::Camera)
                            ->schema([
                                ImageEntry::make('images_before.file_path')
                                    ->label('Before')
                                    ->stacked()
                                    ->simpleLightbox(fn($image) => $image)
                                    ->extraImgAttributes([
                                        'alt' => 'Before Image',
                                        'loading' => 'lazy',
                                    ])
                                    ->imageHeight(200),
                                ImageEntry::make('images_after.file_path')
                                    ->label('After')
                                    ->stacked()
                                    ->simpleLightbox(fn($image) => $image)
                                    ->extraImgAttributes([
                                        'alt' => 'After Image',
                                        'loading' => 'lazy',
                                    ])
                                    ->imageHeight(200),
                            ])->columns(2)
                            ->columnSpanFull(),
                    ])
            ]);
    }
}
