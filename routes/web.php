<?php

use App\Livewire\Inspection;
use App\Livewire\InspectionSurvey;
use App\Models\CleanerTaskReport;
use App\Models\Inspectionreport;
use App\Models\Site;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum', 'verified')->group(function () {
    Route::get('/startInspection', Inspection::class)->name('inspection.start');
    Route::get('/inspection/{report}', InspectionSurvey::class)->name('inspection.survey');
});
Route::get('/check', function () {
    $record = Inspectionreport::first();
    return view('inspect-report-template', ['record' => $record]);
});
Route::get('/task', function () {
    $record = CleanerTaskReport::where('report_number', 'REP-0001')->first();
    return view('task-report-template', ['record' => $record]);
});

Route::get('/qr', function () {
    $record = Site::first();
    return view('qr-template', ['record' => $record]);
});
