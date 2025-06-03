<?php

namespace Faraztanveer\LaravelChat;

use Illuminate\Support\ServiceProvider;

class LaravelChatServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->publishes([
            __DIR__ . '/../config/laravel-chat.php' => config_path('laravel-chat.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-chat.php', 'laravel-chat');
    }
}
