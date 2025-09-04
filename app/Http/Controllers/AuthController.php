<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if (!Auth::attempt([$loginField => $request->login, 'password' => $request->password])) {
            return response()->json([
                'error' => 'The provided credentials are incorrect.'
            ], 401);
        }
        $user = User::where($loginField, $request->login)->first();
        if ($user->is_active === false) {
            return response()->json([
                'error' => 'Your account is inactive. Please contact support.'
            ], 403);
        }
        // if (!$user->hasRole('user')) {
        //     return response()->json([
        //         'error' => 'Unauthorized access.'
        //     ], 403);
        // }

        return response()->json([
            'token' => $user->createToken('api-token')->plainTextToken,
            'user' => $user,
            'role' => $user->getRoleNames()->first()
        ]);
    }
}
