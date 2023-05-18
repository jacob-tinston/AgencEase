<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        return view('tenant.chat.index');
    }

    public function show(Request $request)
    {
        $user = User::find($request->id);

        if (! $user || $user == auth()->user()) {
            abort(404);
        }

        return view('tenant.chat.show')->with([
            'user' => $user,
            'chats' => [],
        ]);
    }

    public function store(Request $request)
    {
        $message = [
            'user' => auth()->user()->name,
            'content' => $request->input('content'),
            'id' => uniqid()
        ];

        auth()->user()->notify(new \App\Notifications\Test('Message Sent'));

        return response()->json($message);
    }
}
