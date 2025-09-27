<?php

namespace App\Filament\Widgets;

use App\Models\UserEnrollment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class CleanerEnrollmentPerSiteChart extends ChartWidget
{
    protected ?string $heading = 'Cleaner Enrollment Per Site Chart';

    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $data = UserEnrollment::select('site_id', DB::raw('COUNT(*) as aggregate'))
            ->with('site:id,name')
            ->groupBy('site_id')
            ->get();
        return [
            'datasets' => [
                [
                    'label' => 'Cleaner',
                    'data' => $data->map(fn($value) => $value->aggregate),
                    'backgroundColor' => [
                        '#36A2EB',
                        '#FF6384',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40',
                        '#00A36C',
                        '#C71585',
                        '#8B0000',
                        '#FFD700',
                        '#20B2AA',
                        '#4169E1',
                        '#708090',
                        '#DC143C',
                        '#ADFF2F',
                        '#FF4500',
                    ],
                    'borderColor' => '#ffffff',
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $data->map(fn($value) => $value->site?->name),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
