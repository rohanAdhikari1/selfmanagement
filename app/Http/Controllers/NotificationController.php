<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function list()
    {
        $user = Auth::user();
        $all = $user->notifications;
        return response()->json([
            'status' => true,
            'result' => $all,
        ]);
    }
}
