<?php

namespace Faraztanveer\LaravelChat\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatChannel extends Model
{
    protected $guarded = [];

    public function participants(): BelongsToMany
    {
        // You can set the model for participants in your config!
        return $this->belongsToMany(
            config('laravel-chat.participant_model', \App\Models\User::class),
            'participant_chat_channels',
            'channel_id',
            'participant_id'
        );
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'channel_id');
    }
}
