<?php

namespace Faraztanveer\LaravelChat\Http\Controllers;

use Faraztanveer\LaravelChat\Models\ChatChannel;
use Faraztanveer\LaravelChat\Http\Resources\MessageResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'channel_id' => 'required|exists:chat_channels,id',
            'body' => 'required|string|max:5000',
        ]);

        $user = $request->user();
        $channel = ChatChannel::findOrFail($request->input('channel_id'));
        $message = $channel->messages()->create([
            'sender_id' => $user->id,
            'body' => $request->input('body'),
        ]);

        // You can add event broadcasting here for new messages if needed

        return new MessageResource($message);
    }

    public function index(Request $request)
    {
        $request->validate([
            'channel_id' => 'required|exists:chat_channels,id',
        ]);

        $messages = ChatChannel::findOrFail($request->input('channel_id'))
            ->messages()
            ->with('sender')
            ->latest()
            ->paginate(50);

        return MessageResource::collection($messages);
    }
}
