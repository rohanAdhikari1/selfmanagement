<?php

namespace App\Filament\Widgets;

use App\Models\Inspectionreport;
use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class InspectionReportWidget extends TableWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';


    protected function getTableQuery(): Builder
    {
        return Inspectionreport::query();
    }


    public function table(Table $table): Table
    {
        return $table
            ->query(fn(): Builder => $this->getTableQuery())
            ->heading('Inspection Reports')
            ->description('Latest Inspection Reports')
            ->columns([
                TextColumn::make('report_no'),
                TextColumn::make('title'),
                TextColumn::make('site.company.name')
                    ->hidden(fn() => auth()->user()->hasAnyRole(['company_user', 'site_user']))
                    ->label('Company'),
                TextColumn::make('site.name')
                    ->hidden(fn() => auth()->user()->hasRole('site_user'))
                    ->label('Site'),
                TextColumn::make('inspection_type')
                    ->label('Inspection Type'),
                // TextColumn::make('frequency')
                //     ->label('Frequency')
                //     ->searchable(),
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
                //
            ])
            ->striped()
            ->paginated(false);
    }
}
