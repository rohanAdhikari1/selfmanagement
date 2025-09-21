<?php

namespace App\Filament\Pages;

use App\Models\InspectionQuestion;
use App\Models\Inspectionreport;
use App\Models\Task;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Collection;

class InspestionReportDetailPage extends Page
{
    public Inspectionreport $report;

    public Collection $reportItems;

    public Collection $tasks;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'inspection-report-detail/{report}';

    protected string $view = 'filament.pages.inspestion-resport-detail-page';

    public function getTitle(): string | Htmlable
    {
        return $this->report->title . ' Inspection Report';
    }

    public function mount()
    {
        $this->tasks = Task::all();
        $this->reportItems = $this->report->items()->with(['question:id,name,total_point,task_id'])->get();
    }

    public function getHeaderPoints(): string
    {
        $total = $this->reportItems->sum('question.total_point');
        $obtained_points = $this->reportItems->sum('obtained_point');
        $percentage = number_format(($obtained_points / $total) * 100, 2);
        return "$obtained_points/$total ($percentage%)";
    }
}
