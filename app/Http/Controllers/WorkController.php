<?php

namespace App\Http\Controllers;

use App\Models\CleanerAttendance;
use App\Models\CleanerTaskReport;
use App\Models\CleanerTaskReportItem;
use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class WorkController extends Controller
{
    public function startWork(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'files.*' => 'required|file|mimes:png|max:10240',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
        ]);
        $userId = auth()->id();
        if (!$userId) {
            return response()->json([
                'status' => false,
                'error' => 'User Not Found.'
            ], 404);
        }
        $attendance = CleanerAttendance::whereNull('end_time')
            ->where('cleaner_id', $userId)
            ->with('enrollment')
            ->first();
        if (!$attendance) {
            return response()->json([
                'status'   => false,
                'error'   => "Error!",
                'message'   => "Please Scan the Qr code from the site to start Work!"
            ]);
        }
        $site_id = $attendance?->enrollment?->site_id;
        if (!$site_id) {
            return response()->json([
                'status'   => false,
                'error'   => "Error!",
                'message'   => "Something Went Wrong!"
            ]);
        }
        DB::beginTransaction();
        try {
            $report = CleanerTaskReport::firstOrCreate([
                'cleaner_id' => $userId,
                'site_id' => $site_id,
                'attendance_id' => $attendance->id,
            ]);
            $reportItem = CleanerTaskReport::create([
                'report_id' => $report->id,
                'task_id' => $request->task_id,
                'start_time' => Carbon::now(),
            ]);
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $uniqueFileName = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('report_images/finish', $uniqueFileName);
                    Image::create([
                        'title' => $reportItem->task->name . ' Before Image',
                        'description' => $reportItem->task->name . ' Before image for report',
                        'file_path' => $path,
                        'file_name' => $uniqueFileName,
                        'file_size' => $file->getSize(),
                        'longitude' => $request->longitude,
                        'latitude' => $request->latitude,
                        'model_type' => CleanerTaskReportItem::class,
                        'model_id' => $reportItem->id,
                        'is_before' => true
                    ]);
                }
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'result' => "Successfully marked task as started!",
                'report_id' => $report->id
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Failed to start task: " . $e->getMessage());
            return response()->json([
                'status' => false,
                'error' => 'Failed to start task.',
                'message' => 'An error occurred while saving your task. Please try again.'
            ], 500);
        }
    }

    public function finishWork(Request $request)
    {
        $request->validate([
            'report_id' => 'required',
            'files.*' => 'required|file|mimes:png|max:10240',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
        ]);
        DB::beginTransaction();
        try {
            $report = CleanerTaskReportItem::findOrFail($request->report_id);
            $report->finish_time = Carbon::now();
            $report->save();

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $uniqueFileName = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('report_images/finish', $uniqueFileName);
                    Image::create([
                        'title' => $report->report?->task->name . 'Completion Image',
                        'description' => $report->report?->task->name . 'Completion image for report',
                        'file_path' => $path,
                        'file_name' => $uniqueFileName,
                        'file_size' => $file->getSize(),
                        'longitude' => $request->longitude,
                        'latitude' => $request->latitude,
                        'model_type' => CleanerTaskReportItem::class,
                        'model_id' => $report->id,
                        'is_before' => false
                    ]);
                }
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'result' => "Successfully marked task as finished!",
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Failed to finish task: " . $e->getMessage());
            return response()->json([
                'status' => false,
                'error' => 'Failed to finish task.',
                'message' => 'An error occurred while saving your task. Please try again.'
            ], 500);
        }
    }

    public function workHistory()
    {
        $userId = auth()->id();
        if (!$userId) {
            return response()->json([
                'status' => false,
                'error' => 'User Not Found.'
            ], 404);
        }
        $cleaner_task_report = CleanerTaskReport::whereNotNull('finish_time')
            ->where('cleaner_id', $userId)
            ->select(
                'site_id',
                'attendance_id',
                DB::raw('DATE(finish_time) as finish_date')
            )
            ->with('site:id,name')
            ->groupBy('site_id', 'attendance_id', DB::raw('DATE(finish_time)'))
            ->orderBy('finish_date')
            ->get();
        return response()->json([
            'status' => true,
            'result' => $cleaner_task_report,
        ]);
    }
}
