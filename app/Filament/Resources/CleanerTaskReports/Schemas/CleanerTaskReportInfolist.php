<?php

namespace App\Filament\Resources\CleanerTaskReports\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CleanerTaskReportInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('task.name')
                    ->label('Task'),
                TextEntry::make('cleaner.full_name')
                    ->label('Cleaner'),
                TextEntry::make('site.name')
                    ->label('Site'),
                TextEntry::make('start_time')
                    ->dateTime(),
                TextEntry::make('finish_time')
                    ->dateTime(),
                ImageEntry::make('images.file_path')
                    ->label('Images')
                    ->imageHeight(40)
                    ->stacked(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
