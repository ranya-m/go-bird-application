<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class MessageController extends Controller
{
    public function index(User $user)
    {
        $users = User::all();
        return view('chat', compact('users', 'user'));
    }

    public function getMessages(Request $request)
    {
        $user = auth()->user();
        $receiverId = $request->input('receiver_id');

        // Fetch messages for the specified sender and receiver
        $messages = Message::where(function ($query) use ($user, $receiverId) {
            $query->where('sender_id', $user->id)->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($user, $receiverId) {
            $query->where('sender_id', $receiverId)->where('receiver_id', $user->id);
        })->orderBy('created_at', 'desc')->limit(10)->get();

        return response()->json(['messages' => $messages]);
    }

    public function getUserMessages($receiverId)
    {
        $user = auth()->user();

        // Fetch messages for the specified sender and receiver
        $messages = Message::where(function ($query) use ($user, $receiverId) {
            $query->where('sender_id', $user->id)->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($user, $receiverId) {
            $query->where('sender_id', $receiverId)->where('receiver_id', $user->id);
        })->orderBy('created_at', 'desc')->limit(10)->get();

        return response()->json(['messages' => $messages]);
    }

    public function storeMessage(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'receiver_id' => 'required|exists:users,id',
        ]);

        $user = auth()->user();
        $message = new Message([
            'content' => $request->input('content'),
            'sender_id' => $user->id,
            'receiver_id' => $request->input('receiver_id'),
        ]);
        $message->save();

        return response()->json(['message' => 'Message sent successfully']);
    }

    public function longPollMessages($lastMessageId)
{
    $newMessages = Cache::remember('new_messages', 30, function () use ($lastMessageId) {
        return Message::where('id', '>', $lastMessageId)->get();
    });

    if ($newMessages->isEmpty()) {
        return response('', 204); // No new messages, return empty response to continue long polling
    }

    return response()->json(['messages' => $newMessages]);
}

public function getUsers()
{
    $users = User::all();

    return response()->json($users);
}
}
