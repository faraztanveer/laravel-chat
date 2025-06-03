<?php

namespace Faraztanveer\LaravelChat\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sender_id' => $this->sender_id,
            'sender_name' => optional($this->sender)->name,
            'body' => $this->body,
            'channel_id' => $this->channel_id,
            'time' => $this->created_at?->format('H:i'),
        ];
    }
}
