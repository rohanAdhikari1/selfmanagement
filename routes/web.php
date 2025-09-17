<?php

use App\Livewire\Inspection;
use App\Livewire\InspectionSurvey;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum', 'verified')->group(function () {
Route::get('/startInspection', Inspection::class)->name('inspection.start');
Route::get('/inspection/{report}', InspectionSurvey::class)->name('inspection.survey');
// });
