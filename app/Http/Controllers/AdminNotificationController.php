<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{
    public function markAsRead()
    {
        auth()->user()->unreadNotifications->each(function ($notification) {
            $notification->markAsRead();
        });
        return response()->json(['success' => true]);
    }
}
