<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')->name('api.')->group(function () {
    Route::get('taskwithenrollment', [BasicController::class, 'taskWithEnrollment'])->name('taskWithEnrollment');
    Route::post('mark_attendance', [BasicController::class, 'markAttendance'])->name('markAttendance');
});
