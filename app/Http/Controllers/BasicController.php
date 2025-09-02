<?php

namespace App\Http\Controllers;

use App\Models\CleanerAttendance;
use App\Models\Task;
use App\Models\UserEnrollment;
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
                ->with('site:id,uid,name,phone,address1,address2')
                ->get();
        }

        return response()->json([
            'status'   => true,
            'is_online' => (bool) $attendance,
            'result'   => $data
        ]);
    }
}
