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

    public function testApp()
    {
        // php artisan websockets:serve
        auth()->user()->notify(new \App\Notifications\AppTest());
    }

    public function testEmail()
    {
        auth()->user()->notify(new \App\Notifications\EmailTest());
    }

    // public function testSMS()
    // {
    //     auth()->user()->notify(new \App\Notifications\SMSTest());
    // }
}
