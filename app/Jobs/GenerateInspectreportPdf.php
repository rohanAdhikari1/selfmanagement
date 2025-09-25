<?php

namespace App\Jobs;

use App\Models\Inspectionreport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GenerateInspectreportPdf implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly Inspectionreport $report) {}

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
    }
}
