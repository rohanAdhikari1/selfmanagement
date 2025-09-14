<?php

use App\Livewire\Inspection;
use App\Livewire\InspectionSurvey;
use Illuminate\Support\Facades\Route;

Route::get('/startInspection', Inspection::class);
Route::get('/inspection/{report}', InspectionSurvey::class)->name('inspection.survey');
