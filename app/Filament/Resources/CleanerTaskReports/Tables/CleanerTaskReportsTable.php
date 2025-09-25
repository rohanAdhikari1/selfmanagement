<?php

namespace App\Filament\Resources\CleanerTaskReports\Tables;

use App\Enums\Role;
use App\Filament\Pages\CleanerTaskReport;
use App\Jobs\GenerateTaskreportPdf;
use App\Models\Company;
use App\Models\Site;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class CleanerTaskReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function ($query) {
                if (auth()->user()->hasRole(Role::COMPANY_USER)) {
                    $query->whereHas('site', function ($q) {
                        $q->where('company_id', auth()->user()->company_id);
                    });
                }
            })
            ->columns([
                TextColumn::make('cleaner.full_name')
                    ->searchable(),
                TextColumn::make('site.company.name')
                    ->searchable(),
                TextColumn::make('site.name')
                    ->searchable(),
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
                            ->default(fn() => auth()->user()->company_id)
                            ->hidden(fn() => auth()->user()->hasRole(Role::COMPANY_USER))
                            ->afterStateUpdated(fn(callable $set) => $set('site_id', null)),

                        Select::make('site_id')
                            ->label('Site')
                            ->placeholder('All')
                            ->options(function (callable $get) {
                                $query = Site::query();
                                if (filled($companyId = $get('company_id'))) {
                                    return $query->where('company_id', $companyId)->pluck('name', 'id')->all();
                                }
                                return [];
                            })->searchable(),
                    ])
                    ->hidden(fn() => auth()->user()->hasRole(Role::SITE_USER))
                    ->columns(2)
                    ->columnSpan(2)
                    ->query(
                        function (Builder $query, array $data): Builder {
                            return $query
                                ->when(
                                    $data['company_id'] ?? null,
                                    fn(Builder $query, $companyId) => $query->whereHas('site', fn($q) => $q->where('company_id', $companyId)),
                                )
                                ->when(
                                    $data['site_id'] ?? null,
                                    fn(Builder $query, $siteId) => $query->where('site_id', $siteId),
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
                DateRangeFilter::make('created_at')
                    ->label('Date')
                    ->placeholder('All')
                    ->defaultThisMonth(),
            ], layout: FiltersLayout::AboveContentCollapsible)
            ->recordActions([
                Action::make('report')
                    ->icon(Heroicon::Document)
                    ->url(fn($record) => CleanerTaskReport::getUrl(['record' => $record])),
                Action::make('create_file')
                    ->label('Generate Report File')
                    ->icon(Heroicon::ArrowDownCircle)
                    ->visible(fn() => auth()->user()->hasAnyRole([Role::SUPER_ADMIN, Role::ADMIN]))
                    ->action(function ($record) {
                        GenerateTaskreportPdf::dispatch($record, Filament::auth()->user());
                        Notification::make()
                            ->title('Generate Request is Made.')
                            ->success()
                            ->send();
                    }),
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
