<?php

namespace App\Filament\Widgets;

use App\Filament\Pages\InspestionReportDetailPage;
use App\Models\Inspectionreport;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class InspectionReportWidget extends TableWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';


    protected function getTableQuery(): Builder
    {
        return Inspectionreport::query()->latest();
    }


    public function table(Table $table): Table
    {
        return $table
            ->query(fn(): Builder => $this->getTableQuery())
            ->heading('Inspection Reports')
            ->description('Latest Inspection Reports')
            ->columns([
                TextColumn::make('report_number')
                    ->label('Report No'),
                TextColumn::make('title'),
                TextColumn::make('site.company.name')
                    ->hidden(fn() => auth()->user()->hasAnyRole(['company_user', 'site_user']))
                    ->label('Company'),
                TextColumn::make('site.name')
                    ->hidden(fn() => auth()->user()->hasRole('site_user'))
                    ->label('Site'),
                // TextColumn::make('inspection_type')
                //     ->label('Inspection Type'),
                TextColumn::make('frequency')
                    ->label('Frequency')
                    ->searchable(),
                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
                TextColumn::make('created_at')
                    ->dateTime('d-M-Y')
                    ->label('Date'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('report')
                    ->icon(Heroicon::Document)
                    ->url(fn($record) => InspestionReportDetailPage::getUrl())
            ])
            ->striped()
            ->paginated(false);
    }
}
