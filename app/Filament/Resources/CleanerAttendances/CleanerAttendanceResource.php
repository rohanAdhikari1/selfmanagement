<?php

namespace App\Filament\Resources\CleanerAttendances;

use App\Enums\Role;
use App\Filament\Resources\CleanerAttendances\Pages\ManageCleanerAttendances;
use App\Models\CleanerAttendance;
use App\Models\Company;
use App\Models\Site;
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
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Indicator;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use UnitEnum;

class CleanerAttendanceResource extends Resource
{
    protected static ?string $model = CleanerAttendance::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CalendarDays;

    protected static string|UnitEnum|null $navigationGroup = 'Basic';

    protected static ?int $navigationSort = 5;

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
                TextEntry::make('enrollment.site.name')
                    ->hidden(fn() => auth()->user()->hasRole('company_user'))
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
            ->modifyQueryUsing(function ($query) {
                if (auth()->user()->hasRole('company_user')) {
                    $query->whereHas('enrollment.site', function ($q) {
                        $q->where('company_id', auth()->user()->company_id);
                    });
                }
            })
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('cleaner.full_name')
                    ->searchable(),
                TextColumn::make('enrollment.site.company.name')
                    ->hidden(fn() => auth()->user()->hasRole('company_user'))
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
                SelectFilter::make('cleaner_id')
                    ->label('Cleaner')
                    ->relationship('cleaner', 'full_name')
                    ->searchable()
                    ->preload(),

                Filter::make('company_site')
                    ->schema([
                        Select::make('company_id')
                            ->label('Company')
                            ->placeholder('All')
                            ->options(
                                Company::pluck('name', 'id')->all()
                            )
                            ->reactive()
                            ->searchable()
                            ->hidden(fn() => auth()->user()->hasRole('company_user'))
                            ->afterStateUpdated(fn(callable $set) => $set('site_id', null)),

                        Select::make('site_id')
                            ->label('Site')
                            ->placeholder('All')
                            ->columnSpan(fn() => auth()->user()->hasRole(Role::COMPANY_USER) ? 2 : 1)
                            ->options(function (callable $get) {
                                $query = Site::query();
                                if (filled($companyId = $get('company_id'))) {
                                    return $query->where('company_id', $companyId)->pluck('name', 'id')->all();
                                }
                                if (auth()->user()->hasRole(Role::COMPANY_USER) && filled($companyId = auth()->user()->company_id)) {
                                    return $query->where('company_id', $companyId)->pluck('name', 'id');
                                }
                                return [];
                            })->searchable(),
                    ])
                    ->hidden(fn() => auth()->user()->hasRole('site_user'))
                    ->columns(2)
                    ->columnSpan(fn() => auth()->user()->hasRole(Role::COMPANY_USER) ? 1 : 2)
                    ->query(
                        function (Builder $query, array $data): Builder {
                            return $query
                                ->when(
                                    $data['company_id'] ?? null,
                                    fn(Builder $query, $companyId) => $query->whereHas('enrollment.site', fn($q) => $q->where('company_id', $companyId)),
                                )
                                ->when(
                                    $data['site_id'] ?? null,
                                    fn(Builder $query, $siteId) => $query->whereHas('enrollment', fn($q) => $q->where('site_id', $siteId)),
                                );
                        }
                    )->indicateUsing(function (array $data): array {
                        $indicators = [];
                        $companyId = $data['company_id'] ?? null;
                        $siteId = $data['site_id'] ?? null;
                        if ($companyId) {
                            $companyName = Company::query()
                                ->where('id', $companyId)
                                ->value('name');
                            if ($companyName) {
                                $indicators['company_id'] = 'Company: ' . $companyName;
                            }
                        }
                        if ($siteId) {
                            $siteName = Site::query()
                                ->where('id', $siteId)
                                ->value('name');
                            if ($siteName) {
                                $indicators['site_id'] = 'Site: ' . $siteName;
                            }
                        }
                        return $indicators;
                    }),
                TernaryFilter::make('end_time')
                    ->label('Working')
                    ->nullable()
                    ->placeholder('All')
                    ->trueLabel('Finished')
                    ->falseLabel('Working')
                    ->searchable(),
                DateRangeFilter::make('created_at')
                    ->label('Date')
                    ->columnSpan(2)
                    ->indicateUsing(function (array $data, DateRangeFilter $component): ?Indicator {
                        $column = 'created_at';
                        $datesString = data_get($data, $column);
                        if (empty($datesString)) {
                            return null;
                        }
                        return Indicator::make(__('filament-daterangepicker-filter::message.period', [
                            'label' => $component->getLabel(),
                            'period' => $datesString
                        ]))->removable(false);
                    })
                    ->defaultThisMonth(),
            ], layout: FiltersLayout::AboveContentCollapsible)
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
