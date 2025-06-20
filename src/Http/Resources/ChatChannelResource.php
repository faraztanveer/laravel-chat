<?php

namespace Faraztanveer\LaravelChat\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatChannelResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'members' => ParticipantResource::collection($this->participants),
            'last_message' => new MessageResource($this->messages()->latest()->first()),
        ];
    }
}
