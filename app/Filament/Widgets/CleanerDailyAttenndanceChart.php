<?php

namespace App\Filament\Widgets;

use App\Models\CleanerAttendance;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class CleanerDailyAttenndanceChart extends ChartWidget
{
    protected ?string $heading = 'Cleaner Daily Attenndance Chart';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $currentMonth = Carbon::now()->month;
        $monthName = Carbon::now()->format('F');
        $dailyAttendance = CleanerAttendance::select(
            DB::raw("DATE_FORMAT(created_at, '%d') as day"),
            DB::raw('COUNT(*) as attendance_count')
        )
            ->whereMonth('created_at', $currentMonth)
            ->whereNotNull('start_time')
            ->groupBy('day')
            ->orderBy('day')
            ->get();
        $today = Carbon::now()->day;
        $range = range(1, $today);
        $data = collect($range)->map(function ($d) use ($dailyAttendance) {
            $dayStr = str_pad($d, 2, '0', STR_PAD_LEFT);
            return $dailyAttendance->firstWhere('day', $dayStr)->attendance_count ?? 0;
        })->toArray();

        return [
            'datasets' => [
                [
                    'label' => "Attendance in {$monthName}",
                    'data' => $data,
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'tension' => 0.1,
                ],
            ],
            'labels' =>  $range,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
