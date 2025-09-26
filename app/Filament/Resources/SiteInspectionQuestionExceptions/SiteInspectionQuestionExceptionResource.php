<?php

namespace App\Filament\Resources\SiteInspectionQuestionExceptions;

use App\Filament\Resources\SiteInspectionQuestionExceptions\Pages\ManageSiteInspectionQuestionExceptions;
use App\Models\SiteInspectionQuestionException;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class SiteInspectionQuestionExceptionResource extends Resource
{
    protected static ?string $model = SiteInspectionQuestionException::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ExclamationTriangle;

    protected static string|UnitEnum|null $navigationGroup = 'Exceptions';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('question_id')
                    ->relationship('inspectionQuestion', 'name')
                    ->searchable()
                    ->required()
                    ->preload(),
                Select::make('site_id')
                    ->relationship('site', 'name')
                    ->searchable()
                    ->required()
                    ->preload(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Task Details')
                    ->schema([
                        TextEntry::make('inspectionQuestion.name')
                            ->label('Task'),
                        TextEntry::make('site.name')
                            ->label('Site'),
                    ]),

                Section::make('Modifier Info')
                    ->schema([
                        TextEntry::make('creator_name')
                            ->label('Created By')
                            ->columnSpan(1),
                        TextEntry::make('updator_name')
                            ->label('Updated By')
                            ->columnSpan(1),
                    ]),

                Section::make('Timestamps')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Created At'),
                        TextEntry::make('updated_at')
                            ->label('Updated At')
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('inspectionQuestion.name')
                    ->label('Task'),
                TextColumn::make('site.name')
                    ->label('Site'),
                TextColumn::make('creator_name')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('updator_name')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageSiteInspectionQuestionExceptions::route('/'),
        ];
    }
}
