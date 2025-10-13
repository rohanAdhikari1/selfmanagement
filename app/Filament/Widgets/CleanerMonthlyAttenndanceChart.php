<?php

namespace App\Filament\Widgets;

use App\Models\CleanerAttendance;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class CleanerMonthlyAttenndanceChart extends ChartWidget
{
    use HasWidgetShield;

    protected ?string $heading = 'Cleaner Monthly Attendance Chart';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $currentYear = Carbon::now()->year;
        $monthlyAttendance = CleanerAttendance::select(
            DB::raw("DATE_FORMAT(created_at, '%m') as month"),
            DB::raw('COUNT(*) as attendance_count')
        )
            ->whereYear('created_at', $currentYear)
            ->whereNotNull('start_time')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $data = collect(range(1, 12))->map(
            fn($m) =>
            $monthlyAttendance->firstWhere('month', $m)->attendance_count ?? 0
        )->toArray();

        return [
            'datasets' => [
                [
                    'label' => "Attendance in {$currentYear}",
                    'data' => $data,
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'tension' => 0.1,
                ],
            ],
            'labels' =>  ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
