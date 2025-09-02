<?php

namespace App\Filament\Resources\Tasks\Resources\InspectionQuestions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class InspectionQuestionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('task_id')
                    ->numeric(),
                TextEntry::make('name'),
                TextEntry::make('order')
                    ->numeric(),
                TextEntry::make('total_point')
                    ->numeric(),
                TextEntry::make('created_by')
                    ->numeric(),
                TextEntry::make('updated_by')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
