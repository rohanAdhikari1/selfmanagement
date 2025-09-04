<?php

namespace App\Http\Controllers;

use App\Models\CleanerAttendance;
use App\Models\CleanerTaskReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WorkController extends Controller
{
    public function startWork(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id'
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
        if (!$attendance) {
            return response()->json([
                'status'   => false,
                'error'   => "Error!",
                'message'   => "Something Went Wrong!"
            ]);
        }
        try {
            $report = CleanerTaskReport::create([
                'cleaner_id' => $userId,
                'site_id' => $site_id,
                'attendance_id' => $attendance->id,
                'task_id' => $request->task_id,
                'start_time' => Carbon::now(),
            ]);
            return response()->json([
                'status' => true,
                'result' => "Successfully marked task as started!",
                'report_id' => $report->id
            ]);
        } catch (\Exception $e) {
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
            'report_id' => 'required'
        ]);
        try {
            $report = CleanerTaskReport::findOrFail($request->report_id);
            $report->finish_time = Carbon::now();
            $report->save();
            return response()->json([
                'status' => true,
                'result' => "Successfully marked task as finished!",
            ]);
        } catch (\Exception $e) {
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
        $cleaner_task_report = CleanerTaskReport::select('cleaner_id', 'site_id', 'attendance_id', 'task_id', 'finish_time')
            ->orderBy('finish_time')
            ->with(['site:id,name', 'task:id,name'])
            ->get();
        $final_data = $cleaner_task_report->groupBy('finish_time')->map(function ($dateGroup) {
            return $dateGroup->groupBy(function ($task) {
                return $task->site->name;
            });
        });
        return response()->json([
            'status' => true,
            'result' => $final_data,
        ]);
    }
}
