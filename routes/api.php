<?php

use Faraztanveer\LaravelChat\Http\Controllers\ChatController;
use Faraztanveer\LaravelChat\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->prefix('chat')->group(function () {
    Route::post('channel', [ChatController::class, 'createChannel']);
    Route::get('channels', [ChatController::class, 'getChannels']);
    Route::get('channel', [ChatController::class, 'getChannel']);
    Route::post('message', [MessageController::class, 'store']);
    Route::get('messages', [MessageController::class, 'index']);
});
