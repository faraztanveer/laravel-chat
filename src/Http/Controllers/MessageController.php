<?php

namespace Faraztanveer\LaravelChat\Http\Controllers;

use Faraztanveer\LaravelChat\Http\Resources\MessageResource;
use Faraztanveer\LaravelChat\Models\ChatChannel;
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

        $message_resource = new MessageResource($message);
        event(new \Faraztanveer\LaravelChat\Events\MessageStored($message));

        return $message_resource;
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
