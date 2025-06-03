<?php

namespace Faraztanveer\LaravelChat\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ParticipantResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->getChatDisplayName(),
            'email' => $this->email,
            // Optionally add more fields or custom metadata here
        ];
    }
}
