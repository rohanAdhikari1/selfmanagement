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
                TextInput::make('name')
                    ->label('Question')
                    ->required(),
                TextInput::make('total_point')
                    ->label('Total Points')
                    ->required()
                    ->numeric()
                    ->default(10),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
