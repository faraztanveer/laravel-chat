<?php

namespace Faraztanveer\LaravelChat\Events;

use Illuminate\Queue\SerializesModels;
use Faraztanveer\LaravelChat\Models\Message;

class MessageStored
{
    use SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }
}
