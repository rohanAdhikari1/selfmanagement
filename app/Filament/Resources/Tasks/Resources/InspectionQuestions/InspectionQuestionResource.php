<?php

namespace App\Filament\Resources\Tasks\Resources\InspectionQuestions;

use App\Filament\Resources\Tasks\Resources\InspectionQuestions\Pages\CreateInspectionQuestion;
use App\Filament\Resources\Tasks\Resources\InspectionQuestions\Pages\EditInspectionQuestion;
use App\Filament\Resources\Tasks\Resources\InspectionQuestions\Pages\ViewInspectionQuestion;
use App\Filament\Resources\Tasks\Resources\InspectionQuestions\Schemas\InspectionQuestionForm;
use App\Filament\Resources\Tasks\Resources\InspectionQuestions\Schemas\InspectionQuestionInfolist;
use App\Filament\Resources\Tasks\Resources\InspectionQuestions\Tables\InspectionQuestionsTable;
use App\Filament\Resources\Tasks\TaskResource;
use App\Models\InspectionQuestion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class InspectionQuestionResource extends Resource
{
    protected static ?string $model = InspectionQuestion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $parentResource = TaskResource::class;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return InspectionQuestionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return InspectionQuestionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InspectionQuestionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'create' => CreateInspectionQuestion::route('/create'),
            'view' => ViewInspectionQuestion::route('/{record}'),
            'edit' => EditInspectionQuestion::route('/{record}/edit'),
        ];
    }
}
