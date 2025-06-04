<?php

namespace Faraztanveer\LaravelChat\Http\Controllers;

use Faraztanveer\LaravelChat\Http\Resources\ParticipantChannelResource;
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

        $channel_resource = new ParticipantChannelResource($channel);
        event(new \Faraztanveer\LaravelChat\Events\ChatChannelCreated($channel_resource));


        return $channel_resource;
    }

    public function getChannels(Request $request)
    {
        $user = $request->user();
        $channels = $user->channels()->with(['participants', 'messages' => fn($q) => $q->latest()->first()])->get();

        return ParticipantChannelResource::collection($channels);
    }

    public function getChannel(Request $request)
    {
        $channel = ChatChannel::with(['participants', 'messages' => fn($q) => $q->latest()->first()])
            ->findOrFail($request->input('channel_id'));

        return new ParticipantChannelResource($channel);
    }
}
