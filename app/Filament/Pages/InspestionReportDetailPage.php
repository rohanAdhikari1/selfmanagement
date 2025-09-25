<?php

namespace App\Filament\Pages;

use App\Models\Inspectionreport;
use App\Models\Task;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class InspestionReportDetailPage extends Page
{
    use HasPageShield;

    public ?Inspectionreport $report = null;

    public Collection $reportItems;

    public Collection $tasks;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'inspection-report-detail/{report}';

    protected string $view = 'filament.pages.inspestion-resport-detail-page';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('report')
                ->label('Download')
                ->icon(Heroicon::Document)
                ->action(function () {
                    $path = $this->report->pdf_path;
                    if (filled($path) && Storage::fileExists($path)) {
                        return response()->download(Storage::temporaryUrl($path));
                    }
                    $this->dispatch('open-modal', id: 'report-missing');
                })
                ->keyBindings(['command+s', 'ctrl+s', 'command+p', 'ctrl+p',])
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return $this->report?->title . ' Inspection Report';
    }

    public function mount()
    {
        if (!$this->report) {
            abort(404);
        }
        $this->tasks = Task::all();
        $this->reportItems = $this->report->items()->with(['question:id,name,total_point,task_id'])->get();
    }

    public function getHeaderPoints(): string
    {
        $total = $this->reportItems->sum('question.total_point');
        $obtained_points = $this->reportItems->sum('obtained_point');
        $percentage = $total > 0 ? number_format(($obtained_points / $total) * 100, 2) : 'N/A';
        return "$obtained_points/$total ($percentage%)";
    }
}
