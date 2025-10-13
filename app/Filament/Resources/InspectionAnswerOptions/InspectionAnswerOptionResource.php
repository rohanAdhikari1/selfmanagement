<?php

namespace App\Filament\Resources\InspectionAnswerOptions;

use App\Filament\Resources\InspectionAnswerOptions\Pages\ManageInspectionAnswerOptions;
use App\Models\InspectionAnswerOption;
use BackedEnum;
use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class InspectionAnswerOptionResource extends Resource
{
    protected static ?string $model = InspectionAnswerOption::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static string|UnitEnum|null $navigationGroup = 'Configuration';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->maxLength(65535),
                TextInput::make('point_percentage')
                    ->label('Point In Percentage')
                    ->numeric()
                    ->suffix('%')
                    ->datalist([
                        '0',
                        '50'
                    ])
                    ->minValue(0)
                    ->maxValue(100)
                    ->required(),
                ColorPicker::make('color_code')
                    ->required()
                    ->label('Color')
                    ->default('#000000'),
                ToggleButtons::make('is_active')
                    ->label('Active Status')
                    ->boolean()
                    ->default(true)
                    ->grouped()
                    ->icons([
                        true => 'heroicon-o-check-circle',
                        false => 'heroicon-o-x-circle',
                    ]),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('point_percentage'),
                TextEntry::make('color_code'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('point_percentage')
                    ->label('Point %')
                    ->sortable(),
                TextColumn::make('color_code')
                    ->label('Color Code'),
                IconColumn::make('is_active')
                    ->label('Active Status')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // ViewAction::make(),
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
            'index' => ManageInspectionAnswerOptions::route('/'),
        ];
    }
}
