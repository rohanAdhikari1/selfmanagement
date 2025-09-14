<?php

namespace App\Filament\Pages;

use App\Filament\Pages\CleanerTaskReport as PagesCleanerTaskReport;
use App\Models\CleanerTaskReport;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Pagination\LengthAwarePaginator;

class CleanerTaskReportList extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.pages.cleaner-task-report-list';
    protected static ?int $navigationSort = 6;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ReceiptPercent;

    protected function getRecords(int $page, int $recordsPerPage): LengthAwarePaginator
    {
        $query = CleanerTaskReport::query();
        $query->with(['site:id,name', 'cleaner:id,full_name']);
        if (auth()->user()->hasRole('company_user')) {
            $query->whereHas('site', function ($q) {
                $q->where('company_id', auth()->user()->company_id);
            });
        }
        $query->select(['site_id', 'cleaner_id', 'attendance_id'])
            ->groupBy(['site_id', 'cleaner_id', 'attendance_id']);
        $total = $query->get()->count();
        $records = $query->skip(($page - 1) * $recordsPerPage)
            ->take($recordsPerPage)
            ->get()->toArray();
        return new LengthAwarePaginator(
            $records,
            total: $total,
            perPage: $recordsPerPage,
            currentPage: $page,
        );
    }

    public function table(Table $table): Table
    {
        return $table
            ->records(fn(int $page, int $recordsPerPage) => $this->getRecords($page, $recordsPerPage))
            ->columns([
                TextColumn::make('cleaner.full_name')
                    ->searchable(),
                TextColumn::make('site.name')
                    ->searchable(),
            ])
            ->filters([
                // ...
            ])
            ->recordActions([
                Action::make('report')
                    ->icon(Heroicon::Document)
                    ->url(fn($record) => PagesCleanerTaskReport::getUrl(['cleaner' => $record['cleaner_id'], 'site' => $record['site_id']]))
            ])
            ->toolbarActions([
                // ...
            ]);
    }
}
