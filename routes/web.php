<?php

use App\Livewire\Inspection;
use App\Livewire\InspectionSurvey;
use App\Models\CleanerTaskReport;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum', 'verified')->group(function () {
    Route::get('/startInspection', Inspection::class)->name('inspection.start');
    Route::get('/inspection/{report}', InspectionSurvey::class)->name('inspection.survey');
});
Route::get('/check', function () {
    return view('inspect-report-template');
});
Route::get('/task', function () {
    $record = CleanerTaskReport::where('report_number', 'REP-0001')->first();
    return view('task-report-template', ['record' => $record]);
});
