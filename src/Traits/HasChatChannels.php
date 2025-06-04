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

    /**
     * Returns display name for chat. Override in your model for custom logic.
     */
    public function getChatDisplayName()
    {
        return $this->name;
    }


    public function chatParticipantColumns()
    {
        return ['id', 'name', 'email']; // Add more as needed
    }
}
