<?php

namespace App\Jobs;

use App\Models\Inspectionreport;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class GenerateInspectreportPdf implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly Inspectionreport $report, private readonly User $user) {}

    public function handle(): void
    {
        $filename = Str::slug($this->report->report_number) . '_' . Str::slug($this->report->title) . '.pdf';
        $pdf = Pdf::loadView('inspect-report-template', [
            'record' => $this->report,
        ]);
        $directory = 'inspection_report/';
        $path =  $directory . $filename;
        File::ensureDirectoryExists(Storage::path($directory));
        Storage::put($path, $pdf->output());
        $this->report->update(['pdf_path' => $path]);
        $this->user->notify(
            Notification::make()
                ->title('Report File Generated')
                ->body('Your Inspection report file generation request is completed.')
                ->success()
                ->toDatabase()
        );
    }

    public function failed(Throwable $exception): void
    {
        $this->user->notify(
            Notification::make()
                ->title('Report Generation Failed')
                ->body('We were unable to generate your Inspection report. Please try again or contact developer if more than 3 request failed.')
                ->danger()
                ->toDatabase()
        );
    }
}
