<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index()
    {
        return view('tenant.settings.index');
    }

    public function update()
    {
        return redirect()->route('settings.index');
    }
}
