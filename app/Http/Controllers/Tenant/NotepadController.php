<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;

class NotepadController extends Controller
{
    public function index()
    {
        return view('tenant.blank');
    }
}
