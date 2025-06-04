<?php

namespace Faraztanveer\LaravelChat\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ParticipantResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [];
        // Loop all columns from trait
        foreach ($this->chatParticipantColumns() as $col) {
            $data[$col] = $this->$col ?? null;
        }

        // You can add computed fields after if you want:
        $data['display_name'] = $this->getChatDisplayName();

        return $data;
    }
}
