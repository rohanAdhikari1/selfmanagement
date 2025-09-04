<?php

namespace App\Filament\Resources\CleanerTaskReports\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CleanerTaskReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('task_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('cleaner_id')
                    ->required()
                    ->numeric(),
                TextInput::make('site_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('attendance_id')
                    ->numeric()
                    ->default(null),
                DateTimePicker::make('start_time')
                    ->required(),
                DateTimePicker::make('finish_time'),
            ]);
    }
}
