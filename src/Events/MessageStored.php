<?php

namespace Faraztanveer\LaravelChat\Events;

use Illuminate\Queue\SerializesModels;

class MessageStored
{
    use SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }
}
