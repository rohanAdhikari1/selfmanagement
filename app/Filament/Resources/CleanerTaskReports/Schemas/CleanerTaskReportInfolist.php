<?php

namespace App\Filament\Resources\CleanerTaskReports\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CleanerTaskReportInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('task_id')
                    ->numeric(),
                TextEntry::make('cleaner_id')
                    ->numeric(),
                TextEntry::make('site_id')
                    ->numeric(),
                TextEntry::make('attendance_id')
                    ->numeric(),
                TextEntry::make('start_time')
                    ->dateTime(),
                TextEntry::make('finish_time')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
