<?php

use Faraztanveer\LaravelChat\Http\Controllers\ChatController;
use Faraztanveer\LaravelChat\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::middleware(config('laravel-chat.route_middleware', ['auth:sanctum']))
    ->prefix(config('laravel-chat.route_prefix', 'chat'))
    ->group(function () {
        Route::post('channel', [ChatController::class, 'createChannel']);
        Route::get('channels', [ChatController::class, 'getChannels']);
        Route::get('channel', [ChatController::class, 'getChannel']);
        Route::post('message', [MessageController::class, 'store']);
        Route::get('messages', [MessageController::class, 'index']);
    });
