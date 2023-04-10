<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function broadcast() {
        auth()->user()->notify(new \App\Notifications\Test('Testing'));
        return;
    }

    public function clearAll() {
        auth()->user()->unreadNotifications()->update(['read_at' => now()]);
        return redirect()->back();
    }
}
