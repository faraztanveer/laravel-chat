<?php

namespace Faraztanveer\LaravelChat\Traits;

use Faraztanveer\LaravelChat\Models\ChatChannel;

trait HasChatChannels
{
    public function channels()
    {
        return $this->belongsToMany(
            ChatChannel::class,
            'participant_chat_channels',
            'participant_id',
            'channel_id'
        );
    }
}
