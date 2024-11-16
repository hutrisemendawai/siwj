<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function index()
    {
        // Retrieve existing chat messages to display
        $messages = ChatMessage::with('user')->get();

        return view('chat.index', ['messages' => $messages]);
    }

    public function store(Request $request)
    {
        $message = ChatMessage::create([
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        broadcast(new MessageSent(auth()->user(), $message))->toOthers();

        return response()->json(['status' => 'Message Sent!']);
    }
}
