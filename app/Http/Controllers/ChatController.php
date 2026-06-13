<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function getUsers()
    {
        if (!auth('sanctum')->check()) {
            return response()->json(['message' => 'Unauthorized. Invalid or missing token.'], 401);
        }

        $users = User::where('id', '!=', auth('sanctum')->id())->get();
        return response()->json($users);
    }

    public function getMessages($userId)
    {
        if (!auth('sanctum')->check()) {
            return response()->json(['message' => 'Unauthorized. Invalid or missing token.'], 401);
        }
        
        $currentUserId = auth('sanctum')->id();

        if (!User::find($userId)) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $messages = Message::where(function ($query) use ($currentUserId, $userId) {
            $query->where('sender_id', $currentUserId)->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($currentUserId, $userId) {
            $query->where('sender_id', $userId)->where('receiver_id', $currentUserId);
        })->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        if (!auth('sanctum')->check()) {
            return response()->json(['message' => 'Unauthorized. Invalid or missing token.'], 401);
        }

        $validator = Validator::make($request->all(), [
            'receiver_id' => 'required|exists:users,id',
            'body' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $message = Message::create([
            'sender_id' => auth('sanctum')->id(),
            'receiver_id' => $request->receiver_id,
            'body' => $request->body,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json($message, 201);
    }
}