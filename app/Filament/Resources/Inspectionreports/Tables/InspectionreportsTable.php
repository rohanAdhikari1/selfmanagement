<?php

namespace App\Filament\Resources\Inspectionreports\Tables;

use App\Enums\Role;
use App\Filament\Pages\InspestionReportDetailPage;
use App\Jobs\GenerateInspectreportPdf;
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
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class InspectionreportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function ($query) {
                if (auth()->user()->hasRole(ROle::COMPANY_USER)) {
                    $query->whereHas('site', function ($q) {
                        $q->where('company_id', auth()->user()->company_id);
                    });
                }
            })
            ->columns([
                TextColumn::make('report_number')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('site.name')
                    ->label('Site')
                    ->searchable(),
                TextColumn::make('site.company.name')
                    ->label('Company')
                    ->hidden(fn() => auth()->user()->hasAnyRole([Role::COMPANY_USER, Role::SITE_USER]))
                    ->searchable(),
                TextColumn::make('inspection_type')
                    ->label('Inspection Type')
                    ->badge()
                    ->searchable(),
                TextColumn::make('frequency')
                    ->badge()
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),
                IconColumn::make('is_draft')
                    ->label('Draft')
                    ->boolean(),
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
                SelectFilter::make('frequency')
                    ->options([
                        'daily' => 'Daily',
                        'weekly' => 'Weekly',
                        'monthly' => 'Monthly',
                        'quarterly' => 'Quarterly',
                        'annually' => 'Annually',
                    ])
                    ->searchable(),


                Filter::make('company_site')
                    ->schema([
                        Select::make('company_id')
                            ->label('Company')
                            ->placeholder('All')
                            ->options(
                                Company::pluck('name', 'id')
                            )
                            ->reactive()
                            ->searchable()
                            ->hidden(fn() => auth()->user()->hasRole(Role::COMPANY_USER))
                            ->afterStateUpdated(fn(callable $set) => $set('site_id', null)),

                        Select::make('site_id')
                            ->label('Site')
                            ->placeholder('All')
                            ->columnSpan(fn() => auth()->user()->hasRole(Role::COMPANY_USER) ? 2 : 1)
                            ->options(function (callable $get) {
                                $query = Site::query();
                                if (filled($companyId = $get('company_id'))) {
                                    return $query->where('company_id', $companyId)->pluck('name', 'id');
                                }
                                if (auth()->user()->hasRole(Role::COMPANY_USER) && filled($companyId = auth()->user()->company_id)) {
                                    return $query->where('company_id', $companyId)->pluck('name', 'id');
                                }
                                return [];
                            })->searchable(),
                    ])
                    ->hidden(fn() => auth()->user()->hasRole(Role::SITE_USER))
                    ->columns(2)
                    ->columnSpan(fn() => auth()->user()->hasRole(Role::COMPANY_USER) ? 1 : 2)
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
                    )
                    ->indicateUsing(function (array $data): array {
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

                TernaryFilter::make('is_draft')
                    ->label('Draft')
                    ->placeholder('All report')
                    ->trueLabel('Draft Report')
                    ->falseLabel('Submited Report')
                    ->searchable(),

                DateRangeFilter::make('created_at')
                    ->label('Date'),
            ], layout: FiltersLayout::AboveContentCollapsible)
            ->recordActions([
                Action::make('report')
                    ->icon(Heroicon::Document)
                    ->url(fn($record) => InspestionReportDetailPage::getUrl(['report' => $record])),
                Action::make('create_file')
                    ->label('Generate Report File')
                    ->icon(Heroicon::ArrowDownCircle)
                    ->visible(fn() => auth()->user()->hasAnyRole([Role::SUPER_ADMIN, Role::ADMIN]))
                    ->action(function ($record) {
                        GenerateInspectreportPdf::dispatch($record, Filament::auth()->user());
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
