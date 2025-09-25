<?php

namespace App\Jobs;

use App\Models\CleanerTaskReport;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Throwable;

class GenerateTaskreportPdf implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly CleanerTaskReport $report, private readonly User $user) {}

    public function handle(): void
    {
        $filename = $this->report->report_number . '_' . $this->report->created_at->format('Y-m-d_H-i-s') . '.pdf';
        $pdf = Pdf::loadView('task-report-template', [
            'record' => $this->report,
        ]);
        $directory = 'task_report/';
        $path =  $directory . $filename;
        File::ensureDirectoryExists(Storage::path($directory));
        Storage::put($path, $pdf->output());
        $this->report->update(['pdf_path' => $path]);
        $this->user->notify(
            Notification::make()
                ->title('Report File Generated')
                ->body('Your Cleaner Task report file generation request is completed.')
                ->success()
                ->toDatabase()
        );
    }

    public function failed(Throwable $exception): void
    {
        $this->user->notify(
            Notification::make()
                ->title('Report Generation Failed')
                ->body('We were unable to generate your Cleaner Task report. Please try again or contact developer if more than 3 request failed.')
                ->danger()
                ->toDatabase()
        );
    }
}
