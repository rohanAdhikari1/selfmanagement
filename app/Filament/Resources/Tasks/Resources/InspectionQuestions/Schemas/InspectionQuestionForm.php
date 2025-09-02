<?php

namespace App\Filament\Resources\Tasks\Resources\InspectionQuestions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class InspectionQuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('task_id')
                    ->required()
                    ->numeric(),
                TextInput::make('name')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('order')
                    ->numeric()
                    ->default(null),
                TextInput::make('total_point')
                    ->required()
                    ->numeric()
                    ->default(10),
                TextInput::make('created_by')
                    ->numeric()
                    ->default(null),
                TextInput::make('updated_by')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
