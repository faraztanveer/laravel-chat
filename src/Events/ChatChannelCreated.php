<?php

namespace Faraztanveer\LaravelChat\Events;

use Illuminate\Queue\SerializesModels;

class ChatChannelCreated
{
    use SerializesModels;

    public $channel;

    public function __construct($channel)
    {
        $this->channel = $channel;
    }
}
