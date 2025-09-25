<?php

namespace App\Jobs;

use App\Models\Inspectionreport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class GenerateInvoicereportPdf implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly Inspectionreport $report) {}

    public function handle(): void {}
}
