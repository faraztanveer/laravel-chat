<?php

namespace Faraztanveer\LaravelChat\Http\Controllers;

use Faraztanveer\LaravelChat\Http\Resources\ChatChannelResource;
use Faraztanveer\LaravelChat\Models\ChatChannel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ChatController extends Controller
{
    public function createChannel(Request $request)
    {
        $user = $request->user();
        $participantId = $request->input('participant_id');

        $participantModel = config('laravel-chat.participant_model', \App\Models\User::class);
        $participant = $participantModel::findOrFail($participantId);

        $ids = collect([$user->id, $participant->id])->sort();
        $channelName = $ids->join('-');

        $channel = ChatChannel::firstOrCreate(['name' => $channelName]);
        $channel->participants()->syncWithoutDetaching([$user->id, $participant->id]);

        $channel_resource = new ChatChannelResource($channel);
        event(new \Faraztanveer\LaravelChat\Events\ChatChannelCreated($channel));

        return $channel_resource;
    }

    public function getChannels(Request $request)
    {
        $user = $request->user();
        $channels = $user->channels()->with(['participants', 'messages' => fn($q) => $q->latest()->first()])->get();

        return ChatChannelResource::collection($channels);
    }

    public function getChannel(Request $request)
    {
        $channel = ChatChannel::with(['participants', 'messages' => fn($q) => $q->latest()->first()])
            ->findOrFail($request->input('channel_id'));

        return new ChatChannelResource($channel);
    }
}
