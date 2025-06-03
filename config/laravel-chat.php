<?php

return [
    'participant_model' => App\Models\User::class,

    // Add these:
    'route_prefix' => 'api/chat',
    'route_middleware' => ['auth:sanctum'],
];
