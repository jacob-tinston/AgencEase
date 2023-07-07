<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = [];

        return view('tenant.tasks.index')->with([
            'tasks' => $tasks,
        ]);
    }
}
