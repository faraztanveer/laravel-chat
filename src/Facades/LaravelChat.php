<?php

namespace Faraztanveer\LaravelChat\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Faraztanveer\LaravelChat\LaravelChat
 */
class LaravelChat extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Faraztanveer\LaravelChat\LaravelChat::class;
    }
}
