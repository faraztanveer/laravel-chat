<?php

namespace Faraztanveer\LaravelChat\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ParticipantChannelResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'members' => $this->participants->map(fn($user) => [
                'id' => $user->id,
                'name' => $user->name ?? ($user->full_name ?? null),
                'email' => $user->email,
            ]),
            'last_message' => new MessageResource($this->messages()->latest()->first()),
        ];
    }
}
