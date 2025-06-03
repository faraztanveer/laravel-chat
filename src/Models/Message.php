<?php

namespace Faraztanveer\LaravelChat\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $guarded = [];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(
            config('laravel-chat.participant_model', \App\Models\User::class),
            'sender_id'
        );
    }

    public function channel(): BelongsTo
    {
        return $this->belongsTo(ChatChannel::class, 'channel_id');
    }
}
