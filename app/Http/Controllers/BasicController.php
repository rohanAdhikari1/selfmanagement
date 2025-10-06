<?php

namespace App\Http\Controllers;

use App\Models\CleanerAttendance;
use App\Models\CleanerTaskReportItem;
use App\Models\Site;
use App\Models\Task;
use App\Models\UserEnrollment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BasicController extends Controller
{
    public function taskWithEnrollment()
    {
        $userId = auth()->id();

        if (!$userId) {
            return response()->json([
                'error' => 'User Not Found.'
            ], 404);
        }

        $attendanceId = CleanerAttendance::whereNull('end_time')
            ->where('cleaner_id', $userId)
            ->value('id');


        if ($attendanceId) {
            $tasks = Task::all();
            $data = $tasks->map(function ($task) use ($attendanceId) {
                $report = CleanerTaskReportItem::where('task_id', $task->id)
                    ->whereHas('report', function ($q) use ($attendanceId) {
                        $q->where('attendance_id', $attendanceId);
                    })
                    ->first();
                return [
                    'id' => $task->id,
                    'name' => $task->name,
                    'description' => $task->description,
                    'report_id' => $report ? $report->id : null,
                    'is_complete' => $report ? (bool) $report->finish_time : false,
                ];
            });
        } else {
            $data = UserEnrollment::where('user_id', $userId)
                ->where('status', true)
                ->with('site:id,uid,name,phone,address1,address2')
                ->get();
        }

        return response()->json([
            'status'   => true,
            'is_online' => (bool) $attendanceId,
            'result'   => $data
        ]);
    }

    public function markAttendance(Request $request)
    {
        $request->validate([
            'company_uid' => 'required|string',
            'file' => 'required|file|mimes:png|max:10240',
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
            ->first();
        $file = $request->file('file');
        $uniqueFileName = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('attendance_images', $uniqueFileName);

        if ($attendance) {
            $attendance->end_time = Carbon::now();
            $attendance->exit_longitude = $request->longitude;
            $attendance->exit_latitude = $request->latitude;
            $attendance->exit_image_path = $path;
            $attendance->save();
        } else {
            $site_id = Site::where('uid', $request->company_uid)->value('id');
            if (!$site_id) {
                return response()->json([
                    'status'   => false,
                    'error'   => "Invalid Qr Code!",
                    'message'   => "Please Scan the Qr code from the site to start Work!"
                ]);
            }
            $enroll_ment_id = UserEnrollment::where('user_id', $userId)
                ->where('site_id', $site_id)
                ->where('status', true)
                ->value('id');
            if (!$enroll_ment_id) {
                return response()->json([
                    'status'   => false,
                    'error'   => "Access Denied!",
                    'message'   => "Your are not enrolled for this. Please contact Administrator!"
                ]);
            }

            CleanerAttendance::create([
                'cleaner_id' => $userId,
                'enrollment_id' => $enroll_ment_id,
                'start_time' => Carbon::now(),
                'entry_longitude' => $request->longitude,
                'entry_latitude' => $request->latitude,
                'entry_image_path' => $path,
            ]);
        }

        return response()->json([
            'status'   => true,
            'result'   => "SuccessFully Marked your attendance!"
        ]);
    }
}
