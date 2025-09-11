<?php

namespace App\Filament\Resources\Tasks\Resources\InspectionQuestions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class InspectionQuestionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Inspection Question Details')
                    ->description('Details about the inspection question, including task, name, and scoring.')
                    ->icon(Heroicon::ClipboardDocumentCheck)
                    ->schema([
                        TextEntry::make('task.name')
                            ->icon(Heroicon::Briefcase)
                            ->label('Task Name')
                            ->numeric(),
                        TextEntry::make('name')
                            ->icon(Heroicon::PencilSquare),
                        TextEntry::make('total_point')
                            ->icon(Heroicon::Star)
                            ->numeric(),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),
                Section::make('System Information')
                    ->description('Automatically captured details about record creation and updates.')
                    ->icon(Heroicon::Cog6Tooth)
                    ->collapsed()
                    ->schema([
                        TextEntry::make('creator_name')
                            ->icon(Heroicon::User)
                            ->numeric(),
                        TextEntry::make('updator_name')
                            ->icon(Heroicon::ArrowPath)
                            ->numeric(),
                        TextEntry::make('created_at')
                            ->label('Created At')
                            ->icon(Heroicon::Calendar)
                            ->dateTime(),
                        TextEntry::make('updated_at')
                            ->label('Updated At')
                            ->icon(Heroicon::Clock)
                            ->dateTime(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
