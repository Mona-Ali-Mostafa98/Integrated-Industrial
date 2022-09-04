<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function notifications(){
        $user =Auth::guard('sanctum')->user();
        // dd($user);

        return response()->json([
            'user-notification' => $user->notifications,
        ], 200);
    }
}
