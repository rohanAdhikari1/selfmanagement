<?php

namespace App\Filament\Resources\CleanerAttendances;

use App\Filament\Resources\CleanerAttendances\Pages\ManageCleanerAttendances;
use App\Models\CleanerAttendance;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CleanerAttendanceResource extends Resource
{
    protected static ?string $model = CleanerAttendance::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CalendarDays;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('cleaner_id')
                    ->required()
                    ->relationship('cleaner', 'full_name')
                    ->searchable()
                    ->preload(),
                Select::make('enrollment_id')
                    ->relationship('enrollment')
                    ->getOptionLabelFromRecordUsing(fn($record) => "{$record->site->name} - {$record->cleaner->full_name}")
                    ->searchable()
                    ->preload(),
                DateTimePicker::make('start_time')
                    ->required(),
                DateTimePicker::make('end_time'),
                Textarea::make('remarks')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('cleaner.full_name')
                    ->numeric(),
                TextEntry::make('enrollment.site.compnay.name')
                    ->label('Site'),
                TextEntry::make('start_time')
                    ->dateTime(),
                TextEntry::make('end_time')
                    ->dateTime(),
                ImageEntry::make('entry_image_path')
                    ->label('Entry Image'),
                ImageEntry::make('exit_image_path')
                    ->label('Exit Image'),
                TextEntry::make('entry_longitude'),
                TextEntry::make('entry_latitude'),
                TextEntry::make('exit_longitude'),
                TextEntry::make('exit_latitude'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('cleaner.full_name')
                    ->searchable(),
                TextColumn::make('enrollment.site.company.name')
                    ->searchable(),
                TextColumn::make('enrollment.site.name')
                    ->searchable(),
                TextColumn::make('start_time')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('end_time')
                    ->dateTime()
                    ->sortable(),
                IconColumn::make('working')
                    ->boolean()
                    ->state(fn($record) => blank($record->end_time)),
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
            'index' => ManageCleanerAttendances::route('/'),
        ];
    }
}
