<?php
return [
    // model for the chat
    'participant_model' => App\Models\User::class,

    //prefix for the routes
    'route_prefix' => 'api/chat',
    // middlewares for the routes
    'route_middleware' => ['auth:sanctum'],
];
