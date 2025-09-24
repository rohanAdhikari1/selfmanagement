<?php

namespace App\Filament\Resources\UserEnrollments\Tables;

use App\Models\Company;
use App\Models\Site;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class UserEnrollmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function ($query) {
                if (auth()->user()->hasRole('company_user')) {
                    $query->whereHas('site', function ($q) {
                        $q->where('company_id', auth()->user()->company_id);
                    });
                }
            })
            ->columns([
                TextColumn::make('cleaner.full_name')
                    ->searchable(),
                TextColumn::make('site.name')
                    ->searchable(),
                TextColumn::make('from_time')
                    ->label('Expected From Time')
                    ->time()
                    ->sortable(),
                TextColumn::make('to_time')
                    ->label('Expected To Time')
                    ->time()
                    ->sortable(),
                IconColumn::make('status')
                    ->boolean(),
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
                DateRangeFilter::make('created_at')
                    ->label('Date')
                    ->defaultThisYear(),
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
                            ->hidden(fn() => auth()->user()->hasRole('company_user'))
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
                    ->hidden(fn() => auth()->user()->hasRole('site_user'))
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
                                ->whereKey($companyId)
                                ->value('name');
                            if ($companyName) {
                                $indicators['company_id'] = "Company: {$companyName}";
                            }
                        }
                        if ($siteId) {
                            $siteName = Site::query()
                                ->whereKey($siteId)
                                ->value('name');
                            if ($siteName) {
                                $indicators['site_id'] = "Site: {$siteName}";
                            }
                        }
                        return $indicators;
                    }),
            ])
            ->recordActions([
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
