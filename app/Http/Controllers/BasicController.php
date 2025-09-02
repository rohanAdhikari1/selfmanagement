<?php

namespace App\Http\Controllers;

use App\Models\CleanerAttendance;
use App\Models\CleanerTaskReport;
use App\Models\Site;
use App\Models\Task;
use App\Models\UserEnrollment;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        $attendance = CleanerAttendance::whereNull('end_time')
            ->where('cleaner_id', $userId)
            ->value('enrollment_id');

        if ($attendance) {
            $data = Task::all();
        } else {
            $data = UserEnrollment::where('user_id', $userId)
                ->where('status', true)
                ->with('site:id,uid,name,phone,address1,address2')
                ->get();
        }

        return response()->json([
            'status'   => true,
            'is_online' => (bool) $attendance,
            'result'   => $data
        ]);
    }

    public function markAttendance(Request $request)
    {
        $request->validate([
            'company_uid' => 'required|string'
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

        if ($attendance) {
            $attendance->end_time = Carbon::now();
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
            ]);
        }

        return response()->json([
            'status'   => true,
            'result'   => "SuccessFully Marked your attendance!"
        ]);
    }

    public function workHistory()
    {
        $cleaner_task_report = CleanerTaskReport::select('cleaner_id', 'site_id', 'attendance_id', 'task_id', 'finish_time')
            ->orderBy('finish_time')
            ->get();
        $final_data = $cleaner_task_report->groupBy('finish_time')->map(function ($dateGroup) {
            return $dateGroup->groupBy('site_id');
        });
        dd($final_data);
    }
}
