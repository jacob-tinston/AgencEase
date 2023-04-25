<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;

class NotificationsController extends Controller
{
    public function destroy($id = null)
    {
        if (! $id) {
            auth()->user()->unreadNotifications()->update(['read_at' => now()]);
        }

        return redirect()->back();
    }
}
